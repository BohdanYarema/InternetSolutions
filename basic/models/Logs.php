<?php

namespace app\models;

use Yii;

class Logs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'date_post'], 'integer'],
            [['user_name', 'operation', 'sql', 'path_operation_text', 'path_operation_link', 'message', 'email', 'files', 'user_role'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Код',
            'user_id' => 'Код Пользователя',
            'operation' => 'Операция',
            'sql' => 'Sql запрос',
            'path_operation_text' => 'Путь к разделу',
            'path_operation_link' => 'Путь к разделу(ссылка)',
            'message' => 'Описание(Текст)',
            'email' => 'Почта',
            'files' => 'Файлы',
            'date_post' => 'Дата',
            'user_role' => 'Права',
            'user_name' => 'Имя',
        ];
    }

    /*registration user on site*/

    public static function loger($user)
    {

        $data = User::findByUsername($user['username']);
        $role = Yii::$app->authManager->getRolesByUser($data->id);

        $time = time();
        $loger = new Logs();
        
        $loger->user_id = $data->id;
        $loger->operation = $user['operation'];
        $loger->sql = '';
        $loger->path_operation_text = $user['text'];
        $loger->path_operation_link = $user['url'];
        $loger->message = $user['message'];
        $loger->email = $data->username;
        $loger->files = '';
        if (!empty($role['user']->name)) {
            $loger->user_role = $role['user']->name;
        } else {
            $loger->user_role = $role['admin']->name;
        }
        $loger->date_post = $time;
        $loger->user_name = $data->u_snp;

        $check = $loger->save();
    }
}
