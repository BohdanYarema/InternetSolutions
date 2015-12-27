<?php

namespace app\module\profile\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\module\profile\models\Compaings;

/**
 * CompaingsSearch represents the model behind the search form about `app\module\admin\models\Compaings`.
 */
class CompaingsSearch extends Compaings
{
    // атрибуты связных таблиц
    public $author;
    public $spheres;
    public $projects;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'date_post', 'date_end', 'date_update', 'id_project', 'id_user', 'id_sphere'], 'integer'],
            [['name', 'unique_link', 'about', 'link', 'author', 'spheres','projects'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Compaings::find();

        $query->joinWith(['spheres']);
        $query->joinWith(['projects']);
        $query->where(['compaings.id_user' => Yii::$app->user->identity->id]); 

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        /*Сортировка*/

        $dataProvider->sort->attributes['spheres'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['spheres.name' => SORT_ASC],
            'desc' => ['spheres.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['projects'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['projects.name' => SORT_ASC],
            'desc' => ['projects.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date_post' => $this->date_post,
            'date_end' => $this->date_end,
            'date_update' => $this->date_update,
            'id_project' => $this->id_project,
            'id_user' => $this->id_user,
            'id_sphere' => $this->id_sphere,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
              ->andFilterWhere(['like', 'about', $this->about])
              ->andFilterWhere(['like', 'link', $this->link])
              ->andFilterWhere(['like', 'unique_link', $this->unique_link])
              ->andFilterWhere(['like', 'spheres.name', $this->author])
              ->andFilterWhere(['like', 'projects.name', $this->projects]);
        return $dataProvider;
    }

    /*фильтр и поиск в просмотре проекта*/

    public function search_view($params)
    {

        //->where(['id_project' => $params['id']] // выборка по проэкту
        /*Compaings::find()->with('author')->where(['id_project' => $params['id']])*/
        $query = Compaings::find();
        
        $query->joinWith(['spheres']);
        $query->where(['id_project' => $params['id']]); 

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // Important: here is how we set up the sorting
        // The key is the attribute name on our "TourSearch" instance
        $dataProvider->sort->attributes['spheres'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['spheres.name' => SORT_ASC],
            'desc' => ['spheres.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date_post' => $this->date_post,
            'date_end' => $this->date_end,
            'date_update' => $this->date_update,
            'id_project' => $this->id_project,
            'id_user' => $this->id_user,
            'id_sphere' => $this->id_sphere,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'about', $this->about])
            ->andFilterWhere(['like', 'unique_link', $this->unique_link])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'spheres.name', $this->spheres]);

        return $dataProvider;
    }
}
