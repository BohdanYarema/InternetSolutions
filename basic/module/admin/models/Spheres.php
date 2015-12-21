<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "Spheres".
 *
 * @property integer $id
 * @property string $name
 * @property integer $date_post
 * @property integer $date_update
 */
class Spheres extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Spheres';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
            'id' => 'Код сферы',
            'name' => 'Название',
            'date_post' => 'Дата создания',
            'date_update' => 'Дата обновления',
        ];
    }
}
