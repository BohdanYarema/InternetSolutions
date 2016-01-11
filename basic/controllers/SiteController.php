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
use app\models\Logs;


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
            /*$password = substr(md5($username),0,8);*/

            /*email for link*/
            $email_link = md5($username.time());

            /*generate activation link*/
            $link = Yii::$app->urlManager->createAbsoluteUrl(['site/activate','code'=> $email_link]);

            if ($user = $model->registrations($email_link,$password)) {


                $data = Yii::$app->request->post('Registration');
                $data['operation'] = 'registration';
                $data['url'] = Url::to('');
                $data['text'] = 'Сайт, страница регистрации';
                $data['message'] = 'Зарегестрировался пользователь под именем -> '.$data['name'].', почтовый ящик -> '.$data['username'];
                $logs = Logs::loger($data);

                /*sending email*/
                $send = User::send_email($model->username,$link);

                return $this->redirect('index.php?r=site/confirmate');
            }
        } else {
            // либо страница отображается первый раз, либо есть ошибка в данных
            return $this->render('registration', ['model' => $model]);
        }
    }

    public function actionActivate($code)
    { 

        $result = User::findByUsername_hash($code);

        if ($result != null) {
            $time = time();
            $check_time = User::findByUsername_check_time($time,$result['u_time_link']);
            if ($check_time == true) {
                /*password*/
                $password = substr(md5($result['username']),0,8);
                /*add password to user*/
                $add = User::add_password($password,$result['username']);

                if ($add == 1) {
                    /*sending password*/
                    $send = User::send_password($password,$result['username']);

                    $data['username'] = $result->username;
                    $data['operation'] = 'activate';
                    $data['url'] = Url::to('');
                    $data['text'] = 'Сайт, страница активации';
                    $data['message'] = 'Прошел активацию пользователь под именем -> '.$result->u_snp.', почтовый ящик -> '.$result->username;
                    $logs = Logs::loger($data);

                    return $this->render('activate', [
                        'code' => $code,
                    ]);
                }
            } else {

            }
        } else {

        }
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

            $data = Yii::$app->request->post('LoginForm');
            $data['operation'] = 'login';
            $data['url'] = Url::to('');
            $data['text'] = 'Сайт, страница входа на сайт';
            $data['message'] = 'Вошел на сайт пользователь, почтовый ящик -> '.$data['username'];
            $logs = Logs::loger($data);

            return $this->goBack();
        }
        
        return $this->render('login', [
            'model' => $model,
        ]);
    }
}
