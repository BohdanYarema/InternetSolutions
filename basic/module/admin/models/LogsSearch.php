<?php

namespace app\module\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\module\admin\models\Logs;

/**
 * LogsSearch represents the model behind the search form about `app\module\admin\models\Logs`.
 */
class LogsSearch extends Logs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'date_post'], 'integer'],
            [['operation', 'sql', 'path_operation_text', 'path_operation_link', 'message', 'email', 'files', 'user_role'], 'safe'],
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
        $query = Logs::find();

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
            'user_id' => $this->user_id,
            'date_post' => $this->date_post,
        ]);

        $query->andFilterWhere(['like', 'operation', $this->operation])
            ->andFilterWhere(['like', 'sql', $this->sql])
            ->andFilterWhere(['like', 'path_operation_text', $this->path_operation_text])
            ->andFilterWhere(['like', 'path_operation_link', $this->path_operation_link])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'files', $this->files])
            ->andFilterWhere(['like', 'user_role', $this->user_role]);

        return $dataProvider;
    }
}
