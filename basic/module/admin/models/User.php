<?php

namespace app\module\admin\models;

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
            [['username', 'password', 'auth_key', 'u_snp', 'u_company', 'u_activation_link'], 'string'],
            [['u_status', 'u_time_link', 'date_post', 'update_post', 'activate_post'], 'integer']
        ];
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
        ];
    }
}
