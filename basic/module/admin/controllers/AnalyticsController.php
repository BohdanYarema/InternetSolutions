<?php

namespace app\module\admin\controllers;

use Yii;
use app\module\admin\models\Analytics;
use app\module\admin\models\AnalyticsSearch;
use app\module\admin\models\Campaigns;
use app\module\admin\models\Detail;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * AnalyticsController implements the CRUD actions for Analytics model.
 */
class AnalyticsController extends Controller
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
     * Lists all Analytics models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnalyticsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        /*ссылки на клиентские кампании*/

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Analytics model.
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
     * Get data form Ajax request and create or update Analytics model.
     * @return mixed
     */
    public function actionAjax_request()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            
            function find_($value1){ // проверка на нужную ссылку
                $value = '/campaigns?id=';
                $result = strpos($value1,$value);
                return $result;
            }
            
            function find_id($value1){ // получение id
                $value = '/campaigns?id=';
                $id = str_replace($value, '', $value1);
                return $id;
            }
            
            if (isset($data['analytics'])) { // проверка на пустоту массива
                $mass = $data['analytics'];
                for ($i=0; $i < count($mass); $i++) { 
                    $result = find_($mass[$i][0]);
                    if (!($result === false)) {
                        $id = find_id($mass[$i][0]);
                        if ($id != '') {
                            $models = Campaigns::Get_info($id);
                            $mass[$i][] = (int)$id;
                            $mass[$i][] = $models->id_user;
                        }
                        $new[] = $mass[$i];
                    }
                }
            } // подготовили массив
            
            for($i=0; $i < count($new); $i++){
                $models = Analytics::Get_info($new[$i][1],$new[$i][5]);
                if($models == ''){
                    $create_ = Analytics::Create_($new[$i]);
                    if($create_ != false){
                        $create_detail_ = Detail::Create_($new[$i],$create_);
                    }
                } else {
                    $check_detail = Detail::Get_info($models->id,$new[$i][2]);
                    if($check_detail == ''){
                        $create_detail_ = Detail::Create_($new[$i],$models->id);
                    } else {
                        $update_detail_ = Detail::Update_($new[$i],$models->id);
                    }
                }
            } 
            

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'data' => 'Данные успешно загружены',
            ];   
        }
    }

    /**
     * Deletes an existing Analytics model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    /*public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }*/

    /**
     * Finds the Analytics model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Analytics the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Analytics::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
