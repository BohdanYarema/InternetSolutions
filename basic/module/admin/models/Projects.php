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

    public function getAuthor() {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

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
            [['name'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Код проекта',
            'name' => 'Название',
            'date_post' => 'Дата создания',
            'date_update' => 'Дата обновления',
            'id_user' => 'Компания',
        ];
    }

    public function afterDelete()
    {
        parent::afterDelete();
        
        Campaigns::deleteAll('id_project = :id_project', [':id_project' => $this->id]);

    }

    public function afterSave($insert, $changedAttributes){
        
        $this->date_update = time();
        $this->updateAttributes(['date_update']);

        parent::afterSave($insert, $changedAttributes);
    }
}
