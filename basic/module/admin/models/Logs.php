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
            [['sql', 'path_operation_text', 'path_operation_link', 'message', 'email', 'files', 'user_role','operation'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Код операции',
            'user_id' => 'Пользователь',
            'operation' => 'Тип дествия',
            'sql' => 'Sql запрос',
            'path_operation_text' => 'Источник опериции',
            'path_operation_link' => 'Источник операции(ссылка)',
            'message' => 'Сообщение',
            'email' => 'Почта',
            'files' => 'Файлы',
            'date_post' => 'Дата',
            'user_role' => 'Права',
        ];
    }
}
