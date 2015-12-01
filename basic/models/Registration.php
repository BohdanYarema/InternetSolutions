<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;

class Registration extends ActiveRecord
{
    public $name;
    public $username;  
	public $company;

    /*Таблица*/
    public static function tableName()
    {
        return 'User';
    }

    public function rules()
    {
        return [
            [['name', 'username','company'], 'required'],
            ['name', 'match', 'pattern' => '/[a-zA-Zа-яА-Я\-]+$/u'],
            ['name', 'string', 'length' => [10, 100]],
            ['company', 'match', 'pattern' => '/[a-zA-Zа-яА-Я0-9]+$/u'],
            ['company', 'string', 'length' => [3, 100]],
            ['username', 'email'],
            ['username', 'unique'],
        ];
    }
 
    /*registration user on site*/

    public function registrations($link)
    {
        $data = time();
        $user = new User();
        
        $user->username = $this->username;
        $user->password = '';
        $user->generateAuthKey();
        $user->u_snp = $this->name;
        $user->u_company = $this->company;
        $user->u_status = 0;
        $user->u_activation_link = $link;
        $user->u_time_link = $data;
        $user->date_post = $data;
        $user->update_post = $data;

        
        return $user->save() ? $user:null; // сохраняем нового пользователя, если все ок то тру, елсе фолс
    }
}