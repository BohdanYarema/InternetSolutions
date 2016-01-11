<?php

namespace app\module\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\module\admin\models\User;

/**
 * UserSearch represents the model behind the search form about `app\module\admin\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'u_status', 'u_time_link', 'date_post', 'update_post'], 'integer'],
            [['username', 'password', 'auth_key', 'u_snp', 'u_company', 'u_activation_link'], 'safe'],
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
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'date_post' => SORT_DESC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'u_status' => $this->u_status,
            'u_time_link' => $this->u_time_link,
            'date_post' => $this->date_post,
            'update_post' => $this->update_post,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'u_snp', $this->u_snp])
            ->andFilterWhere(['like', 'u_company', $this->u_company])
            ->andFilterWhere(['like', 'u_activation_link', $this->u_activation_link]);

        return $dataProvider;
    }
}
