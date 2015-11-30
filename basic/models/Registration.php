<?php

namespace app\models;
use Yii;
use yii\base\Model;

class Registration extends Model
{
    public $name;
    public $email;  
	public $company;

    public function rules()
    {
        return [
            [['name', 'email','company'], 'required'],
            ['name', 'match', 'pattern' => '/[a-zA-Zа-яА-Я\-]+$/u'],
            ['name', 'string', 'length' => [10, 100]],
            ['company', 'match', 'pattern' => '/[a-zA-Zа-яА-Я0-9]+$/u'],
            ['company', 'string', 'length' => [3, 100]],
            ['email', 'email'],
        ];
    }
 
    /*registration user on site*/

    public function registrations($link,$password)
    {
        $data = time();
        $user = new User();
        
        $user->username = $this->email;
        $user->password = $password;
        $user->generateAuthKey();
        $user->u_snp = $this->name;
        $user->u_company = $this->company;
        $user->u_status = 0;
        $user->u_activation_link = $link;
        $user->u_time_link = $data;
        $user->date_post = $data;

        
        return $user->save() ? $user:null; // сохраняем нового пользователя, если все ок то тру, елсе фолс
    }
}