<?php

namespace app\module\admin\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "Campaigns".
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
class Campaigns extends \yii\db\ActiveRecord
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

    public static function Get_links($id_user)
    {
        return static::find()->where(['id_user' => $id_user])->all();
    }

    public static function Get_info($id)
    {
        return static::find()->where(['id' => $id])->one();
    }
    
    public static function Get_site($id)
    {
        return static::find()->where(['id' => $id])->one();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Campaigns';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'about', 'link'], 'string'],
            [['date_post', 'date_end', 'date_begin', 'date_update', 'id_project', 'id_user', 'id_sphere'], 'integer'],
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
            'date_begin' => 'Дата начала',
            'date_update' => 'Дата обновления',
            'date_update' => 'Дата обновления',
            'unique_link' => 'Ссылка',
            'id_user' => 'Компания',
            'id_sphere' => 'Название сферы деятельности',
        ];
    }

    public function afterSave($insert, $changedAttributes){
        
        $this->date_update = time();
        $this->updateAttributes(['date_update']);

        parent::afterSave($insert, $changedAttributes);
    }
}
