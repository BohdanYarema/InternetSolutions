<?php

namespace app\module\admin\controllers;

use Yii;
use app\module\admin\models\User;
use app\module\admin\models\Auth_assignment;
use app\module\admin\models\Auth_assignmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

define('FLASH_CREATE', Yii::$app->params['flashcreate']);
define('FLASH_UPDATE', Yii::$app->params['flashupdate']);
define('FLASH_DELETE', Yii::$app->params['flashdelete']);
define('FLASH_SUCCESSCOMPILTE', Yii::$app->params['flashsuccesscomplite']);
define('FLASH_ERRORCOMPILTE', Yii::$app->params['flasherrorcomplite']);

/**
 * Auth_assignmentController implements the CRUD actions for Auth_assignment model.
 */
class Auth_assignmentController extends Controller
{

    public $layout='main';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Auth_assignment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Auth_assignmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Auth_assignment model.
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     */
    public function actionView($item_name, $user_id)
    {
        $user = User::findByUser_id($user_id);

        return $this->render('view', [
            'model' => $this->findModel($item_name, $user_id),
            'user' => $user,
        ]);
    }

    /**
     * Creates a new Auth_assignment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Auth_assignment();
        $users = User::findByUser_all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('flashcreate', constant('FLASH_CREATE'));
            return $this->redirect(['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'users' => $users,
            ]);
        }
    }

    /**
     * Updates an existing Auth_assignment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     */
    public function actionUpdate($item_name, $user_id)
    {
        $model = $this->findModel($item_name, $user_id);
        $user = User::findByUser_id($user_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('flashupdate', constant('FLASH_UPDATE'));
            return $this->redirect(['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'user' => $user,
            ]);
        }
    }

    /**
     * Deletes an existing Auth_assignment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     */
    public function actionDelete($item_name, $user_id)
    {
        $this->findModel($item_name, $user_id)->delete();
        Yii::$app->session->setFlash('flashdelete', constant('FLASH_DELETE'));
        return $this->redirect(['index']);
    }

    /**
     * Finds the Auth_assignment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $item_name
     * @param string $user_id
     * @return Auth_assignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($item_name, $user_id)
    {
        if (($model = Auth_assignment::findOne(['item_name' => $item_name, 'user_id' => $user_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
