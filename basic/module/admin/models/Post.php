<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "Post".
 *
 * @property integer $id
 * @property string $name
 * @property string $text
 * @property integer $autho_id
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['autho_id'], 'required'],
            [['autho_id'], 'integer'],
            [['name', 'text'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'text' => 'Text',
            'autho_id' => 'Autho ID',
        ];
    }
}
