<?php

namespace app\module\profile\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

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
        return $this->render('index');
    }
}
