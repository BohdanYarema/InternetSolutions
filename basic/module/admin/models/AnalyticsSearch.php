<?php

namespace app\module\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\module\admin\models\Analytics;

/**
 * AnalyticsSearch represents the model behind the search form about `app\module\admin\models\Analytics`.
 */
class AnalyticsSearch extends Analytics
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_campaigns', 'date_post', 'id_user'], 'integer'],
            [['date','link'], 'save']
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
        $query = Analytics::find();

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
            'id_campaigns' => $this->id_campaigns,
            'date' => $this->date,
            'link' => $this->link,
            'date_post' => $this->date_post,
            'id_user' => $this->id_user,
        ]);

        //$query->andFilterWhere(['like', 'informations', $this->informations]);

        return $dataProvider;
    }
}
