<?php

namespace app\module\profile\controllers;

use Yii;
use app\module\profile\models\Analytics;
use app\module\profile\models\Campaigns;
use app\module\profile\models\Detail;
//use app\module\profile\models\AnalyticsSearch;
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
        
        /*ссылки на клиентские кампании*/

    	$id_user = Yii::$app->user->identity->id;
    	$links = Campaigns::Get_links($id_user);
        
        $max = Analytics::Get_max_date();
        $min = Analytics::Get_min_date();

        $max = time();
        $min = strtotime($min);

        $summary = $max - $min;
        $summary = $summary/3600/24;

        for($i=0;$i<count($links);$i++){
            for ($j=0; $j < $summary; $j++) { 
                $massive = Analytics::Get_info($links[$i]->id,date('Ymd',$min+($j*3600*24))); 
                $rows[$links[$i]->id][] = $massive;
            }
        }
        
        for($i=0;$i<count($links);$i++){
            for($j=0;$j<count($rows[$links[$i]->id]);$j++){
                if (count($rows[$links[$i]->id][$j]) == 0){
                    $mass[$i][] = [
                        'data' =>($min+($j*3600*24))*1000,
                        'count' =>0,
                        'id' =>$links[$i]->id,
                        'link' => '/campaigns?id='.$links[$i]->id
                    ]; 
                } else {
                    $result = Detail::Get_count($rows[$links[$i]->id][$j][0]->id);
                    $mass[$i][] = [
                        'data' =>strtotime($rows[$links[$i]->id][$j][0]->date)*1000,
                        'count' =>(int)$result,
                        'id' =>$rows[$links[$i]->id][$j][0]->id_campaigns,
                        'link' =>$rows[$links[$i]->id][$j][0]->link
                    ];  
                }
            }
        }   
        
        return $this->render('index', [
            'mass' => $mass,
            'max' => $max,
            'min' => $min,
            'links' => $links
        ]);
    }
    
    /*отображение данных по запросу*/
    
    public function actionGet_ajax(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            $min = strtotime($data['analytics'][0]);
            $max = strtotime($data['analytics'][1]);

            /*ссылки на клиентские кампании*/

            $id_user = Yii::$app->user->identity->id;
            $links = Campaigns::Get_links($id_user);

            $summary = $max - $min;
            $summary = $summary/3600/24;

            for($i=0;$i<count($links);$i++){
                for ($j=0; $j < $summary; $j++) { 
                    $massive = Analytics::Get_info($links[$i]->id,date('Ymd',$min+($j*3600*24))); 
                    $rows[$links[$i]->id][] = $massive;
                }
            }
            
            for($i=0;$i<count($links);$i++){
                for($j=0;$j<count($rows[$links[$i]->id]);$j++){
                    if (count($rows[$links[$i]->id][$j]) == 0){
                        $mass[$i][] = [
                            'data' =>($min+($j*3600*24))*1000,
                            'count' =>0,
                            'id' =>$links[$i]->id,
                            'link' => '/campaigns?id='.$links[$i]->id
                        ]; 
                    } else {
                        $result = Detail::Get_count($rows[$links[$i]->id][$j][0]->id);
                        $mass[$i][] = [
                            'data' =>strtotime($rows[$links[$i]->id][$j][0]->date)*1000,
                            'count' =>(int)$result,
                            'id' =>$rows[$links[$i]->id][$j][0]->id_campaigns,
                            'link' =>$rows[$links[$i]->id][$j][0]->link
                        ];  
                    }
                }
            }   

            
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'data' => $mass,
                'counts' => count($rows),
                'summary' => $summary   ,
                'max' => $max,
                'min' => $min
            ];
        }
    }
}
