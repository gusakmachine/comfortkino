<?php

namespace common\models\movies;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\movies\Movies;

/**
 * SearchMovies represents the model behind the search form of `common\models\movies\Movies`.
 */
class SearchMovies extends Movies
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'age'], 'integer'],
            [['title', 'description', 'duration', 'poster', 'mob_poster', 'trailer', 'release_date', 'created_at', 'updated_at'], 'safe'],
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
        $query = Movies::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'duration' => $this->duration,
            'age' => $this->age,
            'release_date' => $this->release_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'poster', $this->poster])
            ->andFilterWhere(['like', 'mob_poster', $this->mob_poster])
            ->andFilterWhere(['like', 'trailer', $this->trailer]);

        return $dataProvider;
    }
}
