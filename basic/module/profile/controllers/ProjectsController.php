<?php

namespace app\module\profile\controllers;

use Yii;
use app\module\profile\models\Projects;
use app\module\profile\models\Campaigns;
use app\module\profile\models\CampaignsSearch;
use app\module\profile\models\ProjectsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;



define('FLASH_CREATE', Yii::$app->params['flashcreate']);
define('FLASH_UPDATE', Yii::$app->params['flashupdate']);
define('FLASH_DELETE', Yii::$app->params['flashdelete']);
define('FLASH_SUCCESSCOMPILTE', Yii::$app->params['flashsuccesscomplite']);
define('FLASH_ERRORCOMPILTE', Yii::$app->params['flasherrorcomplite']);


/**
 * ProjectsController implements the CRUD actions for Projects model.
 */
class ProjectsController extends Controller
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
     * Lists all Projects models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Projects model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        $searchModel = new CampaignsSearch();
        $dataProvider = $searchModel->search_view(Yii::$app->request->queryParams);


        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Projects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
     public function actionCreate()
    {
        $model = new Projects();
        $model->date_post = time();
        $model->date_update = time();
        $model->id_user = Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('flashcreate', constant('FLASH_CREATE'));
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Projects model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->date_update = time();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('flashupdate', constant('FLASH_UPDATE'));
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Projects model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    /*public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('flashcreate', constant('FLASH_CREATE'));
        return $this->redirect(['index']);
    }*/
    
    /**
     * Finds the Projects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Projects the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Projects::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
