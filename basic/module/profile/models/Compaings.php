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
            [['about', 'link', 'unique_link'], 'string'],
            [['date_post', 'date_update', 'id_project', 'id_user', 'id_sphere'], 'integer'],
            [['id_project','id_user', 'id_sphere'], 'required'],
            [['date_end'], 'default', 'value' => null],
            ['name', 'string', 'length' => [3]],
            ['name', 'unique', 'filter' => ['id_project' => $this->unique_projects()]],
        ];
    }


    public function unique_projects()
    {
      $name = Yii::$app->request->post();
      $id_project = Yii::$app->request->post();
      $password = Compaings::find()->where(['name' => $name['Compaings']['name'],'id_project' => $id_project['Compaings']['id_project'],'id_user' => Yii::$app->user->identity['id']])->one();

      return $password->id_project;
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Код кaмпании',
            'name' => 'Название',
            'about' => 'Про кaмпанию',
            'link' => 'Ссылка',
            'unique_link' => 'Уникальная ссылка',
            'date_post' => 'Дата создания',
            'date_end' => 'Дата окончания',
            'date_update' => 'Дата обновления',
            'id_project' => 'Название проекта',
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


  public function beforeSave($insert)
  {
      if (parent::beforeSave($insert)) {

          $time = strtotime(Yii::$app->request->post('date_end'));
          $this->date_end = $time;
          $this->date_update = time();

          return true;
      } else {
          return false;
      }
  }

  public function afterSave($insert, $changedAttributes){
    
    $this->unique_link = 'http://insol.in.ua/campaings/'.$this->id;
    $this->updateAttributes(['unique_link']);

    parent::afterSave($insert, $changedAttributes);
  }

}
