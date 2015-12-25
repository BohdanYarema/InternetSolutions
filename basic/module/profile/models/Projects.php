<?php

namespace app\module\profile\models;

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
            [['id', 'date_post', 'date_update', 'id_user'], 'integer'],
            [['name'], 'required'],
            ['name', 'string', 'length' => [3]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Код проэкта',
            'name' => 'Название',
            'date_post' => 'Дата создания',
            'date_update' => 'Дата обновления',
            'id_user' => 'Автор',
        ];
    }

    public static function all_users_projects($user_id)
    {
        return static::find()->where(['id_user' => $user_id])->all();
    }
}
