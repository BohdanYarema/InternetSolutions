<?php
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class ProfilefullWidget extends Widget{
	public $data;

	public function init(){
		parent::init();
	}
	public function run(){   
        return $this->render('profilefull', [
        	'data' => $this->data
        ]);
	}
}
?>