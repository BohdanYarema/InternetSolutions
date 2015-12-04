<?php

namespace app\module\admin\controllers;

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

    	//$auth = Yii::$app->authManager;

        //$auth = Yii::$app->authManager;

        // добавляем разрешение "createPost"
        /*$createPost = $auth->createPermission('profile/default/index');
        $createPost->description = 'profile -> index';
        $auth->add($createPost);*/

    	// добавляем разрешение "index"
        /*$index = $auth->createPermission('profile/default/index');
       
        $admin = $auth->createRole('author');
        $auth->addChild($admin, $index);*/





        return $this->render('index');
    }
}
