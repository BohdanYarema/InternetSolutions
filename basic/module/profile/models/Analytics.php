<?php

namespace app\module\profile\models;

use Yii;

/**
 * This is the model class for table "Analytics".
 *
 * @property integer $id
 * @property integer $id_campaigns
 * @property string $referal
 * @property integer $date_post
 * @property integer $date_update
 * @property integer $id_user
 * @property integer $date
 * @property string $visits
 * @property string $link
 * @property string $domain
 * @property string $session
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
            [['id_campaigns', 'date_post', 'id_user', 'date'], 'integer'],
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
            'date' => 'Дата посещения',
            'link' => 'Ссылка на компанию',
            'date_post' => 'Дата создания',
            'id_user' => 'Код клиента',
            'id_campaigns' => 'Код кампании',
        ];
    }
    
    // максимальный день
    public static function Get_max_date(){
        return static::find()->max('date');
    }
    // минимальный день
    public static function Get_min_date(){
        return static::find()->min('date');
    }
    
    // минимальный день
    public static function Get_min_date_id($links_id){
        return static::find()->where(['id_campaigns' => $links_id])->orderBy("date ASC")->one();
    }

    // информация по кампаниям
    public static function Get_analytics_info($id){
        return Analytics::find()->where(['id_campaigns' => $id])->all();
    }

    public static function Get_info_data($id,$min,$max){
        /*return Analytics::find()->where(['id_campaigns' => $id])->orderBy('date')->all();*/
        return Analytics::find()->where(['id_campaigns' => $id])->andWhere(['between', 'date', $min, $max ])->orderBy('date')->all();
    }

    // информация по кампаниям
    public static function Get_info($id,$date){
        return Analytics::find()->where(['id_campaigns' => $id,'date' => $date])->orderBy('date')->all();
    }


    public static function Get_statistic($id)
    {

        $max = date('Ymd');
        $week = date('Ymd',time() - (7*3600*24));
        $mounth = date('Ymd',time() - (30*3600*24));

        $links_week     = Analytics::find()->where(['id_campaigns' => $id])->andWhere(['between', 'date', $week, $max ])->orderBy('date')->all();
        $links_mounth   = Analytics::find()->where(['id_campaigns' => $id])->andWhere(['between', 'date', $mounth, $max ])->orderBy('date')->all();
        $links_all      = Analytics::find()->where(['id_campaigns' => $id])->orderBy('date')->all();


        return $result = [
            'week' => $links_week,
            'mounth' => $links_mounth,
            'all' => $links_all,
        ];

        //SELECT SUM(visits) FROM Detail WHERE id_analytics IN(1,3,5,7,8) 
    }

}
