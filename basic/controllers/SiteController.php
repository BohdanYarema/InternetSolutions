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
use app\models\GoogleAnalyticsAPI;
use app\module\admin\models\Campaigns;
use app\module\admin\models\Analytics;
use app\module\admin\models\Detail;



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

    public function actionCharts()
    {
        return $this->render('charts');
    }

    public function actionCampaigns($id)
    {
        $url = Campaigns::Get_site($id);
        $url = $url->link;
        $url = str_replace('http://', '', $url);
        $url = str_replace('https://', '', $url);
        $url = str_replace('www.', '', $url);
        
        return $this->render('campaigns', [
            'id' => $id, 'url' => $url
        ]);
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

    public function actionCron()
    {

        $client_id = '746431818850-sddh6at9g6o18hbmi82rh13tu2mi3pbg.apps.googleusercontent.com';
        $client_secret = 'mz1lOoqB9oslvGZVhoT6KS-V';
        $redirect_uri = 'http://insol.madeforpets.com.ua/cron';
        $account_id = 'ga:114815562';

        session_start();

        $_SESSION['oauth_access_token'] = 'ya29.jAK-QzSp8fb_ou3CxnTp2SY_WEZ5aQF5JjxNmu9kpan_C0roaG6I1nFVGlOQJXL94MAU';

        $ga = new GoogleAnalyticsAPI(); 
        $ga->auth->setClientId($client_id);
        $ga->auth->setClientSecret($client_secret);
        $ga->auth->setRedirectUri($redirect_uri);

        if (isset($_GET['force_oauth'])) {
            $_SESSION['oauth_access_token'] = null;
        }

        if (!isset($_SESSION['oauth_access_token']) && !isset($_GET['code'])) {
            // Go get the url of the authentication page, redirect the client and go get that token!
            $url = $ga->auth->buildAuthUrl();
            header("Location: ".$url);
        }

        if (!isset($_SESSION['oauth_access_token']) && isset($_GET['code'])) {
            $auth = $ga->auth->getAccessToken($_GET['code']);
            if ($auth['http_code'] == 200) {
                $accessToken    = $auth['access_token'];
                $refreshToken   = $auth['refresh_token'];
                $tokenExpires   = $auth['expires_in'];
                $tokenCreated   = time();
                
                // For simplicity of the example we only store the accessToken
                // If it expires use the refreshToken to get a fresh one
                $_SESSION['oauth_access_token'] = $accessToken;
            } else {
                die("Sorry, something wend wrong retrieving the oAuth tokens");
            }
        }

        if (!empty($_SESSION['oauth_access_token'])) {
            $ga->setAccessToken($_SESSION['oauth_access_token']);
            $ga->setAccountId($account_id);

            // Set the default params. For example the start/end dates and max-results
            $defaults = array(
                'start-date' => '2016-01-01',
                'end-date' => 'today',
            );
            $ga->setDefaultQueryParams($defaults);

            $params = array(
                'metrics' => 'ga:pageviews,ga:sessionDuration',
                'dimensions' => 'ga:pagePath,ga:date,ga:fullReferrer',
                'sort' => '-ga:date',
            );
            $visits = $ga->query($params);
        }

        $data = $visits['rows'];

        if (isset($data)) { // проверка на пустоту массива
            $mass = $data;
            for ($i=0; $i < count($mass); $i++) { 
                $result = $this->find_($mass[$i][0]);
                if (!($result === false)) {
                    $id = $this->find_id($mass[$i][0]);
                    if ($id != '') {
                        $models = Campaigns::Get_info($id);
                        $mass[$i][] = (int)$id;
                        $mass[$i][] = $models->id_user;
                    }
                    $new[] = $mass[$i];
                }
            }
        }

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

        return $this->render('cron',[
            'data' => $data
        ]);
    }

    protected function find_($rows){ // проверка на нужную ссылку
        $value = '/campaigns?id=';
        $result = strpos($rows,$value);
        return $result;
    }
    
    protected function find_id($rows){ // получение id
        $value = '/campaigns?id=';
        $id = str_replace($value, '', $rows);
        return $id;
    }
}
