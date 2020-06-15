<?php

namespace common\models\sessions;

use common\models\movies\Movies;
use common\models\sessions\Sessions;
use common\models\theaters\Halls;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ActorsSearch represents the model behind the search form of `common\models\movies\Actors`.
 */
class SessionsSearch extends Sessions
{

    public $movie;
    public $times;
    public $hall;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['date', 'movie', 'hall'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Sessions::find();
        $query->joinWith(['movie', 'hall']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['movie'] = [
            'asc' => [Movies::tableName().'.title' => SORT_ASC],
            'desc' => [Movies::tableName().'.title' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['hall'] = [
            'asc' => [Halls::tableName().'.name' => SORT_ASC],
            'desc' => [Halls::tableName().'.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', Movies::tableName().'.title', $this->movie])
            ->andFilterWhere(['like', Halls::tableName().'.name', $this->hall]);

        return $dataProvider;
    }
}
