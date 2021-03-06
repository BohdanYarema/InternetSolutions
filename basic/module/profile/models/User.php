<?php

namespace app\module\profile\models;

use Yii;

/**
 * This is the model class for table "User".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $u_snp
 * @property string $u_company
 * @property integer $u_status
 * @property string $u_activation_link
 * @property integer $u_time_link
 * @property integer $date_post
 * @property integer $update_post
 */
class User extends \yii\db\ActiveRecord
{
    public $password_old;
    public $password_new;
    public $password_new_dublicate; 

    const SCENARIO_PASSWORD = 'password';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'User';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'auth_key', 'u_snp', 'u_company', 'u_status', 'u_activation_link', 'u_time_link', 'date_post', 'update_post'], 'required'],
            [['username', 'password','auth_key', 'u_snp', 'u_company', 'u_activation_link'], 'string'],
            [['u_status', 'u_time_link', 'date_post', 'update_post', 'activate_post'], 'integer'],
            [['password_new_dublicate'], 'compare', 'compareAttribute' => 'password_new','message'=>'Пароли не совпадают.'] ,
            ['password_old', 'compare', 'compareValue'=>$this->bla(), 'on'=>self::SCENARIO_PASSWORD],
            ['password_new', 'string', 'length' => [6], 'on'=>self::SCENARIO_PASSWORD],
            ['password_new', 'match', 'pattern' => '/(.)\\1{2}/', 'message'=>'Пароль содержит больше 3-х одинаковых символов.', 'not' => 'password_new', 'on'=>self::SCENARIO_PASSWORD],
            [['password_old', 'password_new_dublicate', 'password_new'], 'required', 'on'=>self::SCENARIO_PASSWORD]
        ];
    }

    

    public function bla()
    {
        //$password = '2404';
        $password = User::find()
            ->where(['id' => Yii::$app->user->identity['id']])
            ->one();
        return $password->password;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Идентификатор пользователя',
            'username' => 'Логин',
            'password' => 'Пароль',
            'auth_key' => 'Авторизационній ключ',
            'u_snp' => 'ФИО',
            'u_company' => 'Компания',
            'u_status' => 'Статус',
            'u_activation_link' => 'Активационная ссылка',
            'u_time_link' => 'Время ссылки',
            'date_post' => 'Дата создания',
            'update_post' => 'Дата обновления',
            'activate_post' => 'Дата активации',
            'password_old' => 'Старый пароль',
            'password_new' => 'Новый пароль',
            'password_new_dublicate' => 'Повторите новый пароль',
        ];
    }
}
