<?php

namespace app\module\profile\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\module\profile\models\Analytics;
use app\module\profile\models\Campaigns;
use app\module\profile\models\Detail;

class DefaultController extends Controller
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
    
    public function actionIndex()
    {
        
        /*ссылки на клиентские кампании*/

    	$id_user = Yii::$app->user->identity->id;

        /*Поулчаем последнюю компанию и список аналитики кампании*/

        $date_analytics = $this->Get_date($id_user);


        if ($date_analytics['check'] == 1) {

            $mass_min = $date_analytics['min'];
            /*код компании*/
            $id = $mass_min->id_campaigns;
            /*количество дней с UNIX time*/
            $summary = $this->Get_summ($mass_min->date);
            /*получаем записи аналитики по минимальной дате и коду кампании*/
            $massive = $this->Get_all_analytics($id);
            /*получаем данные для графика*/
            $rows = $this->Get_rows($massive,$summary,$id);
            /*получаем дополнительную инфу по записям с датами*/
            $mass = $this->Get_counts($rows);
            /*получаем статистику по данной кампании*/
            $statistic = $this->Get_statistic_all($id);

            $min = strtotime($mass_min->date);
            $max = time();


            $data = [
                'max' => $max = $max*1000,
                'min' => $min = $min*1000,
                'mass' => $mass,
                'id' => $id,
                'count_week_stat' => $statistic['count_week_stat'],
                'count_mounth_stat' => $statistic['count_mounth_stat'],
                'count_all_stat' => $statistic['count_all_stat'],
                'counts' => 1,
            ];

        } elseif ($date_analytics['check'] == 2) {
            $data = [
                'max' => 0,
                'min' => 0,
                'mass' => false,
                'id' => 0,
                'count_week_stat' => 0,
                'count_mounth_stat' => 0,
                'count_all_stat' => 0,
                'counts' => 1,
            ];
        } else {
            $data = [
                'counts' => 0,
            ];
        }
        
        
        return $this->render('index', [ 
            'data' => $data
        ]);
    }
    
    /*отображение данных по запросу*/
    
    public function actionGet_ajax(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            $min = strtotime($data['analytics'][0]);
            $max = strtotime($data['analytics'][1]);
            $id = $data['analytics'][2];

            $summary = $max - $min;
            $summary = $summary/3600/24;

            for ($j=0; $j < $summary; $j++) { 
                $massive = Analytics::Get_info($id,date('Ymd',$min+($j*3600*24))); 
                $rows[] = $massive;
            }

            for($j=0;$j<count($rows);$j++){
                if (count($rows[$j]) == 0){
                    $mass[] = [
                        'data' =>($min+($j*3600*24))*1000,
                        'count' =>0,
                        'id' =>$id,
                        'link' => '/campaigns?id='.$id
                    ]; 
                } else {
                    $result = Detail::Get_count($rows[$j][0]->id);
                    $mass[] = [
                        'data' =>strtotime($rows[$j][0]->date)*1000,
                        'count' =>(int)$result,
                        'id' =>$rows[$j][0]->id_campaigns,
                        'link' =>$rows[$j][0]->link
                    ];  
                }
            }

            if(empty($mass)){
                $mass = false;
            }

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'data' => $mass,
                'summary' => $summary   ,
                'max' => $max,
                'min' => $min,
            ];
        }
    }

    public function Get_date($id){
        $counts = Campaigns::Get_count($id);

        if ($counts > 0) {
            /*Последняя запись*/
            $links = Campaigns::Get_max_date_link($id);

            /*первая запись аналитики по последней кампании*/
            $min = Analytics::Get_min_date_id($links->id);

            if (!empty($min)) {
                $result['check'] = 1;
                $result['min'] = $min; 
                return $result;
            } else {
                $result['check'] = 2;
                $result['min'] = ''; 
                return $result;
            }
        } else {
            $result['check'] = 0;
            $result['min'] = ''; 
            return $result;
        }
    }

    public function Get_summ($min){
        $min = strtotime($min);
        $max = time();
        $summ = ($max - $min)/3600/24;
        if ($summ == 0) {
            $summ = 1;
        }
        for ($i=0; $i < $summ; $i++) { 
            $summary[] = $min + $i*24*3600;
        }
        return $summary;
    }

    public function Get_all_analytics($id){
        $data = Analytics::Get_analytics_info($id);
        return $data;
    }

    public function Get_rows($analytics,$summary,$id){

        for ($i=0; $i < count($summary); $i++) { 
            $check = 0;
            $data_summary = date('Ymd',$summary[$i]);

            for ($j=0; $j < count($analytics); $j++) { 
                $data_analytics = $analytics[$j]->date;
                if ($data_analytics == $data_summary) {
                    $check = 1;
                    $rows[] = [
                        'data' => $analytics[$j],
                        'check' => 1   
                    ];
                }
            }

            if ($check == 0) {    
                $rows[] = [
                    'data' => [
                        'date' => strtotime($data_summary),
                        'count' => 0,
                        'id' => $id,
                        'link' => '/campaigns?id='.$id,
                    ],
                    'check' => 0,
                ];
            }
        }
        return $rows;
    }

    public function Get_counts($rows){
        for($i=0;$i<count($rows);$i++){
            if ($rows[$i]['check'] != 0) {
                $result = Detail::Get_count($rows[$i]['data']->id);
                $mass[] = [
                    'data' =>strtotime($rows[$i]['data']->date)*1000,
                    'count' =>(int)$result,
                    'id' =>$rows[$i]['data']->id_campaigns,
                    'link' =>$rows[$i]['data']->link
                ]; 
            } else {
                $mass[] = [
                    'data' =>$rows[$i]['data']['date']*1000,
                    'count' =>$rows[$i]['data']['count'],
                    'id' =>$rows[$i]['data']['id'],
                    'link' => $rows[$i]['data']['link'],
                ]; 
            }
        } 

        return $mass;
    }

    public function Get_statistic_all($id){
        $statistic = Analytics::Get_statistic($id);
        $count_week = count($statistic['week']);
        $count_mounth = count($statistic['mounth']);
        $count_all = count($statistic['all']);

        if ($count_week > 0 ) {
            for ($i=0; $i < count($statistic['week']); $i++) {
                $data = $statistic['week'][$i]; 
                $count_week_stat += Detail::Get_count($data->id);
            }
        } else {
            $count_week_stat = 0;
        }

        if ($count_mounth > 0 ) {
            for ($i=0; $i < count($statistic['mounth']); $i++) {
                $data = $statistic['mounth'][$i]; 
                $count_mounth_stat += Detail::Get_count($data->id);
            }
        } else {
            $count_mounth_stat = 0;
        }

        if ($count_all > 0 ) {
            for ($i=0; $i < count($statistic['all']); $i++) {
                $data = $statistic['all'][$i]; 
                $count_all_stat += Detail::Get_count($data->id);
            }
        } else {
            $count_all_stat = 0;
        }

        $data = [
            'count_week_stat' => $count_week_stat,
            'count_mounth_stat' => $count_mounth_stat,
            'count_all_stat' => $count_all_stat,
        ];

        return $data;
    }
    
}
