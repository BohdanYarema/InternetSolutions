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
 * @property integer $date_post
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
            [['id'], 'required'],
            [['id', 'user_id', 'date_post'], 'integer'],
            [['sql'], 'string'],
            [['operation'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'operation' => 'Operation',
            'sql' => 'Sql',
            'date_post' => 'Date Post',
        ];
    }
}
