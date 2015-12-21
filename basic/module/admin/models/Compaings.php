<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "Compaings".
 *
 * @property integer $id
 * @property string $name
 * @property string $about
 * @property string $link
 * @property integer $date_post
 * @property integer $date_end
 * @property integer $date_update
 * @property integer $id_project
 * @property integer $id_user
 * @property integer $id_sphere
 */
class Compaings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Compaings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'about', 'link'], 'string'],
            [['date_post', 'date_end', 'date_update', 'id_project', 'id_user', 'id_sphere'], 'integer'],
            [['id_project', 'id_user', 'id_sphere'], 'required']
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
            'about' => 'About',
            'link' => 'Link',
            'date_post' => 'Date Post',
            'date_end' => 'Date End',
            'date_update' => 'Date Update',
            'id_project' => 'Id Project',
            'id_user' => 'Id User',
            'id_sphere' => 'Id Sphere',
        ];
    }
}
