<?php

namespace app\models;

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
}