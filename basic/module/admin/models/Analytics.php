<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "Analytics".
 *
 * @property integer $id
 * @property integer $id_campaigns
 * @property string $informations
 * @property integer $date_post
 * @property integer $date_update
 * @property integer $id_user
 */
class Analytics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Analytics';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_campaigns', 'id_user'], 'required'],
            [['id_campaigns', 'date', 'date_post', 'id_user'], 'integer'],
            [['link'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Код',
            //'referal' => 'Страница источник',
            'date' => 'Дата посещения',
            //'visits' => 'Количество  посещений',
            //'session' => 'Время перебывания',
            'link' => 'Ссылка на компанию',
            //'domain' => 'Адрес сайта',
            'date_post' => 'Дата создания',
            //'date_update' => 'Дата обновления',
            'id_user' => 'Код клиента',
            'id_campaigns' => 'Код кампании',
        ];
    }

    public static function Get_info($date,$id)
    {
        return static::find()->where([
            'id_campaigns' => $id,
            'date' => $date
        ])->one();
    }

    public static function Create_($massive)
    {   
        $model = new Analytics();
        $model->id_campaigns = $massive[5];
        $model->id_user = $massive[6];
        $model->link = $massive[0];
        $model->date = $massive[1];
        $model->date_post = time();
        if($model->save()){
            return $model->id;
        } else {
            return false;
        }    
    }
    
}
