<?php

namespace app\module\profile\controllers;

use Yii;
use app\module\profile\models\Projects;
use app\module\profile\models\Spheres;
use app\module\profile\models\Campaigns;
use app\module\profile\models\CampaignsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

define('FLASH_CREATE', Yii::$app->params['flashcreate']);
define('FLASH_UPDATE', Yii::$app->params['flashupdate']);
define('FLASH_DELETE', Yii::$app->params['flashdelete']);
define('FLASH_SUCCESSCOMPILTE', Yii::$app->params['flashsuccesscomplite']);
define('FLASH_ERRORCOMPILTE', Yii::$app->params['flasherrorcomplite']);


/**
 * CampaignsController implements the CRUD actions for Campaigns model.
 */
class CampaignsController extends Controller
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
     * Lists all Campaigns models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CampaignsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Campaigns model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Campaigns model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $projects = Projects::all_users_projects(Yii::$app->user->identity->id); // проекты пользователя
        $spheres = Spheres::all_spheres(); // список сфер деятельности

        $time = Yii::$app->request->get();

        if (!empty($time['analytics'])) {
            $time_end = ($time['analytics'])/1000;
            $time_end = $time_end + 10*24*3600;
            $time_end = date('Y-m-d',$time_end);
        } else {
            $time = time();
            $time_begin = date('Y-m-d',$time);
            $time = time() + 10*24*3600;
            $time_end = date('Y-m-d',$time);
        }

        $model = new Campaigns();
        $model->id_user = Yii::$app->user->identity->id;
        $model->date_post = time();  

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('flashcreate', constant('FLASH_CREATE'));
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'projects' => $projects,
                'spheres' => $spheres,
                'time_begin' => $time_begin,
                'time_end' => $time_end,
            ]);
        }
    }


    /**
     * Creates a new Campaigns model wuth declarated projects name.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate_own($id)
    {

        $projects = Projects::all_users_projects_id(Yii::$app->user->identity->id,$id); // проекты пользователя
        $spheres = Spheres::all_spheres(); // список сфер деятельности

        $model = new Campaigns();
        $model->id_user = Yii::$app->user->identity->id;
        $model->date_post = time();

        $time = Yii::$app->request->get();

        if (!empty($time['analytics'])) {
            $time_end = ($time['analytics'])/1000;
            $time_end = $time_end + 10*24*3600;
            $time_end = date('Y-m-d',$time_end);
        } else {
            $time = time();
            $time_begin = date('Y-m-d',$time);
            $time = time() + 10*24*3600;
            $time_end = date('Y-m-d',$time);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('flashcreate', constant('FLASH_CREATE'));
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create_own', [
                'model' => $model,
                'projects' => $projects,
                'spheres' => $spheres,
                'time_begin' => $time_begin,
                'time_end' => $time_end,
            ]);
        }
    }

    /**
     * Updates an existing Campaigns model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $projects = Projects::all_users_projects_one(Yii::$app->user->identity->id,$model->id_project); // проекты пользователя
        $spheres = Spheres::all_spheres(); // список сфер деятельности

        $time = Yii::$app->request->get();

        if (!empty($time['analytics'])) {
            $time_end= ($time['analytics'])/1000;
            $time_end = $time_end + 10*24*3600;
            $time_end = date('Y-m-d',$time_end);
        } else {
            $time_begin = $model->date_begin;
            $time_begin = date('Y-m-d',$time_begin);
            $time_end   = $model->date_end;
            $time_end   = date('Y-m-d',$time_end);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('flashupdate', constant('FLASH_UPDATE'));
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'projects' => $projects,
                'spheres' => $spheres,
                'time_begin' => $time_begin,
                'time_end' => $time_end,
            ]);
        }
    }

    /**
     * Deletes an existing Campaigns model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    /*public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('flashdelete', constant('FLASH_DELETE'));
        return $this->redirect(['index']);
    }*/

    /**
     * Finds the Campaigns model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Campaigns the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Campaigns::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
