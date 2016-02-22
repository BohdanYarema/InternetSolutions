<?php

namespace app\module\profile\models;

use Yii;

/**
 * This is the model class for table "Detail".
 *
 * @property integer $id
 * @property integer $visits
 * @property string $referal
 * @property double $session
 * @property integer $id_analytics
 * @property integer $date_post
 * @property integer $date_update
 */
class Detail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['visits', 'id_analytics', 'date_post', 'date_update'], 'integer'],
            [['referal'], 'string'],
            [['session'], 'number'],
            [['id_analytics'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'visits' => 'Visits',
            'referal' => 'Referal',
            'session' => 'Session',
            'id_analytics' => 'Id Analytics',
            'date_post' => 'Date Post',
            'date_update' => 'Date Update',
        ];
    }
    
    public static function Get_info($id){
        return Detail::find()->where(['id_analytics' => $id])->all();
    }
    
    public static function Get_count($id){
        return Detail::find()->where(['id_analytics' => $id])->sum('visits');
    }    
}
