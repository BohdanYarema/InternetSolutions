<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "Projects".
 *
 * @property integer $id
 * @property string $name
 * @property integer $date_post
 * @property integer $date_update
 */
class Projects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Projects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'date_post', 'date_update'], 'integer'],
            [['name'], 'string']
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
            'date_post' => 'Date Post',
            'date_update' => 'Date Update',
        ];
    }
}
