<?php

namespace app\module\profile\models;

use Yii;

/**
 * This is the model class for table "Compaings".
 *
 * @property integer $id
 * @property string $name
 * @property string $about
 * @property string $link
 * @property string $unique_link
 * @property integer $date_post
 * @property integer $date_end
 * @property integer $date_update
 * @property integer $id_project
 * @property integer $id_user
 * @property integer $id_sphere
 */
class Compaings extends \yii\db\ActiveRecord
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

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Compaings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'about', 'link', 'unique_link'], 'string'],
            [['date_post', 'date_update', 'id_project', 'id_user', 'id_sphere'], 'integer'],
            [['id_project', 'name', 'id_user', 'id_sphere'], 'required'],
            [['date_end'], 'default', 'value' => null],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Код компании',
            'name' => 'Название',
            'about' => 'Про компанию',
            'link' => 'Ссылка',
            'unique_link' => 'Уникальная ссылка',
            'date_post' => 'Дата создания',
            'date_end' => 'Дата окончания',
            'date_update' => 'Дата обновления',
            'id_project' => 'Название проэкта',
            'id_user' => 'Автор',
            'id_sphere' => 'Название сферы деятельности',
            'id_spheres' => 'Название сферы деятельности',
        ];
    }

    public static function transliterate($input){
        $gost = array(
           "Є"=>"YE","І"=>"I","Ѓ"=>"G","і"=>"i","№"=>"-","є"=>"ye","ѓ"=>"g",
           "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D",
           "Е"=>"E","Ё"=>"YO","Ж"=>"ZH",
           "З"=>"Z","И"=>"I","Й"=>"J","К"=>"K","Л"=>"L",
           "М"=>"M","Н"=>"N","О"=>"O","П"=>"P","Р"=>"R",
           "С"=>"S","Т"=>"T","У"=>"U","Ф"=>"F","Х"=>"X",
           "Ц"=>"C","Ч"=>"CH","Ш"=>"SH","Щ"=>"SHH","Ъ"=>"'",
           "Ы"=>"Y","Ь"=>"","Э"=>"E","Ю"=>"YU","Я"=>"YA",
           "а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d",
           "е"=>"e","ё"=>"yo","ж"=>"zh",
           "з"=>"z","и"=>"i","й"=>"j","к"=>"k","л"=>"l",
           "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
           "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"x",
           "ц"=>"c","ч"=>"ch","ш"=>"sh","щ"=>"shh","ъ"=>"",
           "ы"=>"y","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya",
           " "=>"_","—"=>"_",","=>"_","!"=>"_","@"=>"_",
           "#"=>"-","$"=>"","%"=>"","^"=>"","&"=>"","*"=>"",
           "("=>"",")"=>"","+"=>"","="=>"",";"=>"",":"=>"",
           "'"=>"","\""=>"","~"=>"","`"=>"","?"=>"","/"=>"",
           "\/"=>"","["=>"","]"=>"","{"=>"","}"=>"","|"=>""
        );
        
        $link = strtr($input, $gost); 
        $link = 'http://insol.in.ua/campaings/'.strtr($input, $gost);
        return $link;
    }


}
