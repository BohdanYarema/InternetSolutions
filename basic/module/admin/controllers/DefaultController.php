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

    	/*$auth = Yii::$app->authManager;
        
        $createPost = $auth->createPermission('profile/compaings/daterange');
        $createPost->description = 'profile->compaings->daterange';
        $auth->add($createPost);
        
        $create = $auth->getPermission('profile/compaings/daterange');
        
        $admin = $auth->getRole('admin');
        $auth->addChild($admin, $create);
        
        $admin = $auth->getRole('user');
        $auth->addChild($admin, $create);*/
        

        /*
        
        $createPost = $auth->createPermission('admin/spheres/create');
        $createPost->description = 'admin->spheres->create';
        $auth->add($createPost);
        
        $createPost = $auth->createPermission('admin/spheres/view');
        $createPost->description = 'admin->spheres->view';
        $auth->add($createPost);
        $createPost = $auth->createPermission('admin/spheres/update');
        $createPost->description = 'admin->spheres->update';
        $auth->add($createPost);
        $createPost = $auth->createPermission('admin/spheres/index');
        $createPost->description = 'admin->spheres->index';
        $auth->add($createPost);
        $createPost = $auth->createPermission('admin/spheres/delete');
        $createPost->description = 'admin->spheres->delete';
        $auth->add($createPost);



        $create = $auth->getPermission('admin/spheres/create');
        $view = $auth->getPermission('admin/spheres/view');
        $update = $auth->getPermission('admin/spheres/update');
        $index = $auth->getPermission('admin/spheres/index');
        $delete = $auth->getPermission('admin/spheres/delete');


        $admin = $auth->getRole('admin');
        $auth->addChild($admin, $create);
        $auth->addChild($admin, $view);
        $auth->addChild($admin, $update);
        $auth->addChild($admin, $index);
        $auth->addChild($admin, $delete);*/

       /* $createPost = $auth->createPermission('admin/projects/index');
        $createPost->description = 'profile -> index';
        $auth->add($createPost);

        $createPost = $auth->createPermission('admin/projects/index');
        $createPost->description = 'profile -> index';
        $auth->add($createPost);

        $createPost = $auth->createPermission('admin/projects/index');
        $createPost->description = 'profile -> index';
        $auth->add($createPost);

        $createPost = $auth->createPermission('admin/projects/index');
        $createPost->description = 'profile -> index';
        $auth->add($createPost);*/

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
