<?php

namespace app\module\profile\controllers;

use Yii;
use app\module\profile\models\User;
use app\module\profile\models\Password;
use app\module\profile\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{

    public $layout='main';

    public function behaviors()
    {
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                    'matchCallback' => function ($rule, $action){
                        $module     = Yii::$app->controller->module->id;
                        $action     = Yii::$app->controller->action->id;
                        $controller = Yii::$app->controller->id;
                        $route      = "$module/$controller/$action";
                        $post = Yii::$app->request->post();
                        if (Yii::$app->user->can($route)) {
                            return true;
                        }
                    }
                ],
            ],
        ];
        return $behaviors;
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView()
    {   
        $id = Yii::$app->user->identity['id'];
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $id = Yii::$app->user->identity['id'];
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    public function actionPassword()
    {
        $id = Yii::$app->user->identity['id'];
        $model = $this->findModel($id);
        $model->scenario = User::SCENARIO_PASSWORD;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->password = $model->password_new;
            $model->save();
            return $this->redirect(['view']);
        } else {
            return $this->render('password', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel()
    {
        $id = Yii::$app->user->identity['id'];
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
