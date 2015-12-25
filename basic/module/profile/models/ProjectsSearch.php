<?php

namespace app\module\profile\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\module\profile\models\Projects;

/**
 * ProjectsSearch represents the model behind the search form about `app\module\admin\models\Projects`.
 */
class ProjectsSearch extends Projects
{

    // add the public attributes that will be used to store the data to be search
    public $author;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'date_post', 'date_update', 'id_user'], 'integer'],
            [['name','author'], 'safe'],
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
        $query = Projects::find();

        $query->where(['id_user' => Yii::$app->user->identity->id]); 

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date_post' => $this->date_post,
            'date_update' => $this->date_update,
            'id_user' => $this->id_user,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
