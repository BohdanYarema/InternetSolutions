<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $u_id
 * @property string $u_email
 * @property string $u_snp
 * @property string $u_company
 * @property integer $u_activated
 * @property string $u_activation_link
 * @property integer $u_time_link
 * @property string $u_password
 * @property integer $u_access
 * @property integer $date_post
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['u_email', 'u_snp', 'u_company', 'u_activated', 'u_activation_link', 'u_time_link', 'u_password', 'u_access', 'date_post'], 'required'],
            [['u_email', 'u_snp', 'u_company', 'u_activation_link', 'u_password'], 'string'],
            [['u_activated', 'u_time_link', 'u_access', 'date_post'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'u_id' => 'Код пользователя',
            'u_email' => 'Почтовый ящик',
            'u_snp' => 'ФИО',
            'u_company' => 'Название компании',
            'u_activated' => 'Статус активации',
            'u_activation_link' => 'Ссылка для активации',
            'u_time_link' => 'Дата регистрации ссылки',
            'u_password' => 'Пароль',
            'u_access' => 'Роль',
            'date_post' => 'Дата регистрации',
        ];
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

    /*registration user on site*/

    public static function registrations($name,$email,$company,$link,$password)
    {
        $data = time();

        $users = new Users();

        /*
        $users->u_email = $email;
        $users->u_snp = $name;
        $users->u_company = $company;
        $users->u_activated = 0;
        $users->u_activation_link = $link;
        $users->u_time_link = $data;
        $users->u_password = $password;
        $users->u_access = 1;
        $users->date_post = $data;*/

        $values = [
            'u_email' => $email,
            'u_snp' => $name,
            'u_company' => $company,
            'u_activated' => 0,
            'u_activation_link' => $link,
            'u_time_link' => $data,
            'u_password' => $password,
            'u_access' => 1,
            'date_post' => $data,
        ];

        $users->attributes = $values;
        $users->save();   
    }
}
