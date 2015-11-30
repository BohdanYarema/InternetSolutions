<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;
use \yii\web\IdentityInterface;

/**
 * This is the model class for table "User".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $u_snp
 * @property string $u_company
 * @property string $u_status
 * @property string $u_activation_link
 * @property integer $u_time_link
 * @property string $date_post
 */


class User extends ActiveRecord implements IdentityInterface
{
    /*Таблица*/
    public static function tableName()
    {
        return 'User';
    }

    /*Правила*/
    public function rules()
    {
        return [
            [['username', 'auth_key', 'u_snp', 'u_company', 'u_status', 'u_activation_link', 'u_time_link', 'date_post'], 'required'],
            [['username', 'password', 'auth_key', 'u_snp', 'u_company', 'u_activation_link'], 'string'],
            [['u_time_link','date_post','u_status'], 'integer']
        ];
    }

    /*Название атрибутов*/
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'u_snp' => 'U Snp',
            'u_company' => 'U Company',
            'u_status' => 'U Status',
            'u_activation_link' => 'U Activation Link',
            'u_time_link' => 'U Time Link',
            'date_post' => 'Date Post',
        ];
    }

    /*ключ авторизации*/
    /*хелперы*/

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /*поисе по имени*/
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /*проверка пароля*/
    public function validatePassword($password)
    {
        return $password === $this->password;
    }

    /* аутентификация */

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /*sending message to main*/

    public static function send_email($email,$link)
    {
        $sendmail = Yii::$app->mailer->compose()
            ->setFrom('test@test.com')
            ->setTo($email)
            ->setSubject('Подтверждение регистрации')
            ->setTextBody('')
            ->setHtmlBody('<b>Здравствуйте!
                Для активации вашего аккаунта на сайте <a href="http://b2b.insol.in.ua/basic/web/index.php?r=site%2Findex">insol.in.ua</a> перейдите, пожалуйста, по ссылке 
                <br><a href="'.$link.'">ссылка</a><br>
                Данная ссылка действует 48 часов.<br>
                Если вы получили это письмо случайно и не проходили регистрацию на сайте <a href="http://b2b.insol.in.ua/basic/web/index.php?r=site%2Findex">insol.in.ua</a>, то проигнорируйте его.
                <br><br>
                С уважением,
                Команда Internet Solutions</b>')
            ->send();

        return $sendmail;
    }
}
