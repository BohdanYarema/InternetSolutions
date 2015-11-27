<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Url;
//use yii\db\Query;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;
use app\models\Registration;
use app\models\Users;


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
            $name = $model->name;
            $email = $model->email;
            $company = $model->company;

            /*password*/
            $password = substr(md5($email),0,8);

            /*email for link*/
            $email_link = md5($email);

            /*code*/
            $code = md5($name.time());

            /*generate activation link*/
            //$link = 'http://internetsolutions/basic/web/index.php?r=site%2Factivate&code='.md5($name.time());
            $link = Yii::$app->urlManager->createAbsoluteUrl(['site/activate','code'=> $email_link,'link'=>$code]);

            /*registrate uers*/
            $registration = Users::registrations($name,$email,$company,$link,$password);
            
            /*sending email*/
            $send = Users::send_email($email,$link);
            
            if ($send) {
                return $this->redirect('index.php?r=site/confirmate');
            }
            
        } else {
            // либо страница отображается первый раз, либо есть ошибка в данных
            return $this->render('registration', ['model' => $model]);
        }
    }

     public function actionActivate($code,$link)
    {
        $check = ''; // проверка на вхождение 
        $email_check = ''; // нужный имейл
        $users = (new \yii\db\Query()) // выборка из базы 
            ->from('Users')
            ->all();

        $calc = count($users); // количество записей

        /*ищем имейл из ссылки*/
        for ($i=0; $i < $calc; $i++) { 
            $users_hash = md5($users[$i]['u_email']); // хеш мыла
            if ($users_hash === $code) {
                 $check = 1;
                 $email_check = $users[$i]['u_email'];
            }
        }



        return $this->render('activate', [
                'code' => $code,
                'link' => $link,
                'email_check' => $email_check,
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

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    /*public function actionLogin()
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
    }*/
}
