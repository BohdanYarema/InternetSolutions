<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "auth_assignment".
 *
 * @property string $item_name
 * @property string $user_id
 * @property integer $created_at
 */
class auth_assignment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_assignment';
    }

    public function getAuthor() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id'], 'required'],
            [['created_at'], 'integer'],
            [['item_name', 'user_id'], 'string', 'max' => 64],
            ['item_name', 'unique', 'targetAttribute' => ['item_name', 'user_id'], 'message' => 'Такая запись для этого пользователя уже существует!!!'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_name' => 'Права',
            'user_id' => 'Код пользователя',
            'created_at' => 'Дата добавления',
        ];
    }

    public function afterSave($insert, $changedAttributes){
        
        $this->created_at = time();
        $this->updateAttributes(['created_at']);

        parent::afterSave($insert, $changedAttributes);
    }
}
