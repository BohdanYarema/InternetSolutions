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

    public function getAuthor() {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    public function getSpheres() {
        return $this->hasOne(Spheres::className(), ['id' => 'id_sphere']);
    }

    public function getProjects() {
        return $this->hasOne(Projects::className(), ['id' => 'id_project']);
    }

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
            'id' => 'Код кампании',
            'name' => 'Название',
            'about' => 'Про кампанию',
            'link' => 'Ссылка',
            'date_post' => 'Дата создания',
            'date_end' => 'Дата окончания',
            'date_update' => 'Дата обновления',
            'id_project' => 'Название проекта',
            'id_user' => 'Автор',
            'id_sphere' => 'Название сферы деятельности',
        ];
    }

    public function afterSave($insert, $changedAttributes){
        
        $this->date_update = time();
        $this->updateAttributes(['date_update']);

        parent::afterSave($insert, $changedAttributes);
    }
}
