<?php

namespace app\module\admin\models;

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
    
    public static function Get_info($id,$massive){
        $model = Detail::find()->where([
            'referal' => $massive,
            'id_analytics' => $id
        ])->one();
        
        return $model;
    }
    
    public static function Create_($massive,$id)
    {   
        $model = new Detail();
        
        $model->referal = $massive[2];
        $model->visits = $massive[3];
        $model->session = $massive[4];
        
        $model->id_analytics = $id;
        
        $model->date_post = time();
        $model->date_update = time();
        return $model->save();
        
    }
    
    public static function Update_($massive,$id)
    {   
        $model = Detail::find()->where([
            'referal' => $massive[2],
            'id_analytics' => $id
        ])->one();
        
        $model->visits = $massive[3];
        $model->session = $massive[4];
        $model->date_post = time();
        $model->date_update = time();
        
        return $model->save();
    }
}
