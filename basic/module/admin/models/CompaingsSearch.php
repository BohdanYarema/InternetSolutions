<?php

namespace app\module\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\module\admin\models\Compaings;

/**
 * CompaingsSearch represents the model behind the search form about `app\module\admin\models\Compaings`.
 */
class CompaingsSearch extends Compaings
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'date_post', 'date_end', 'date_update', 'id_project', 'id_user', 'id_sphere'], 'integer'],
            [['name', 'about', 'link'], 'safe'],
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
            'date_end' => $this->date_end,
            'date_update' => $this->date_update,
            'id_project' => $this->id_project,
            'id_user' => $this->id_user,
            'id_sphere' => $this->id_sphere,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'about', $this->about])
            ->andFilterWhere(['like', 'link', $this->link]);

        return $dataProvider;
    }
}
