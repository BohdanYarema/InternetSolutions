<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "Logs".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $operation
 * @property string $sql
 * @property string $path_operation_text
 * @property string $path_operation_link
 * @property string $message
 * @property string $email
 * @property string $files
 * @property integer $date_post
 * @property string $user_role
 */
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
}
