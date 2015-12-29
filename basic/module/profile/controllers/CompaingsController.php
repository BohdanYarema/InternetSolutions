<?php

namespace app\module\profile\controllers;

use Yii;
use app\module\profile\models\Projects;
use app\module\profile\models\Spheres;
use app\module\profile\models\Compaings;
use app\module\profile\models\CompaingsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompaingsController implements the CRUD actions for Compaings model.
 */
class CompaingsController extends Controller
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
     * Lists all Compaings models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompaingsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Compaings model.
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
     * Creates a new Compaings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $projects = Projects::all_users_projects(Yii::$app->user->identity->id); // проекты пользователя
        $spheres = Spheres::all_spheres(); // список сфер деятельности

        $model = new Compaings();
        $model->id_user = Yii::$app->user->identity->id;
        $model->date_post = time();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'projects' => $projects,
                'spheres' => $spheres,
            ]);
        }
    }



    /**
     * Creates a new Compaings model wuth declarated projects name.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate_own($id)
    {

        $projects = Projects::all_users_projects_id(Yii::$app->user->identity->id,$id); // проекты пользователя
        $spheres = Spheres::all_spheres(); // список сфер деятельности

        $model = new Compaings();
        $model->id_user = Yii::$app->user->identity->id;
        $model->date_post = time();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create_own', [
                'model' => $model,
                'projects' => $projects,
                'spheres' => $spheres,
            ]);
        }
    }

    /**
     * Updates an existing Compaings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $projects = Projects::all_users_projects(Yii::$app->user->identity->id); // проекты пользователя
        $spheres = Spheres::all_spheres(); // список сфер деятельности

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'projects' => $projects,
                'spheres' => $spheres,
            ]);
        }
    }

    /**
     * Deletes an existing Compaings model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Compaings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Compaings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Compaings::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
