<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;
use app\models\Registration;
use app\models\User;


class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRegistration()
    {
        $model = new Registration();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                
             /*password*/
            $password = substr(md5($email),0,8);

            /*email for link*/
            $email_link = md5($email);

            /*code*/
            $code = md5($name.time());

            /*generate activation link*/
            //$link = 'http://internetsolutions/basic/web/index.php?r=site%2Factivate&code='.md5($name.time());
            $link = Yii::$app->urlManager->createAbsoluteUrl(['site/activate','code'=> $email_link,'link'=>$code]);

            if ($user = $model->registrations($link,$password)) {
                /*sending email*/
                $send = User::send_email($email,$link);
                return $this->redirect('index.php?r=site/confirmate');
            }
        } else {
            // либо страница отображается первый раз, либо есть ошибка в данных
            return $this->render('registration', ['model' => $model]);
        }
    }

    public function actionActivate($code,$link)
    { 
        return $this->render('activate', [
            'code' => $code,
            'link' => $link,
        ]);
    }

    public function actionConfirmate()
    {
        return $this->render('confirmate');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /*public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }*/

    /*public function actionAbout()
    {
        return $this->render('about');
    }*/

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        
        return $this->render('login', [
            'model' => $model,
        ]);
    }
}
