<?php

namespace common\models\sessions;

use common\models\movies\Movies;
use common\models\theaters\Cities;
use common\models\theaters\Halls;
use common\models\theaters\MovieTheaters;
use common\models\theaters\PlacesSets;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SeacrhTickets represents the model behind the search form of `common\models\sessions\Tickets`.
 */
class SeacrhTickets extends Tickets
{
    public $cities_name;
    public $movie_theaters_title;
    public $halls_name;
    public $movies_title;
    public $sessions_date;
    public $times_time;
    public $times_price;
    public $placesSets_place;
    public $placesSets_row;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'customer_phone', 'status', 'sessions_id', 'place_id', 'movie_id', 'hall_id', 'movie_theaters_id', 'city_id', 'times_id'], 'integer'],
            [['cities_name', 'movie_theaters_title', 'halls_name', 'movies_title', 'sessions_date', 'times_time', 'times_price', 'placesSets_place', 'placesSets_row', 'created_at', 'updated_at',], 'safe'],
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
        $query = Tickets::find()->where(['status' => 0]);
        $query->joinWith(['city']);
        $query->joinWith(['movieTheaters']);
        $query->joinWith(['hall']);
        $query->joinWith(['movie']);
        $query->joinWith(['sessions']);
        $query->joinWith(['times']);
        $query->joinWith(['place']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $dataProvider->sort->attributes['cities_name'] = ['asc' => [Cities::tableName().'.name' => SORT_ASC], 'desc' => [Cities::tableName().'.name' => SORT_DESC]];
        $dataProvider->sort->attributes['movie_theaters_title'] = ['asc' => [MovieTheaters::tableName().'.name' => SORT_ASC], 'desc' => [MovieTheaters::tableName().'.name' => SORT_DESC]];
        $dataProvider->sort->attributes['halls_name'] = ['asc' => [Halls::tableName().'.name' => SORT_ASC], 'desc' => [Halls::tableName().'.name' => SORT_DESC]];
        $dataProvider->sort->attributes['movies_title'] = ['asc' => [Movies::tableName().'.title' => SORT_ASC], 'desc' => [Movies::tableName().'.title' => SORT_DESC]];
        $dataProvider->sort->attributes['sessions_date'] = ['asc' => [Sessions::tableName().'.data' => SORT_ASC], 'desc' => [Sessions::tableName().'.data' => SORT_DESC]];
        $dataProvider->sort->attributes['times_time'] = ['asc' => [Times::tableName().'.time' => SORT_ASC], 'desc' => [Times::tableName().'.time' => SORT_DESC]];
        $dataProvider->sort->attributes['times_price'] = ['asc' => [Times::tableName().'.price' => SORT_ASC], 'desc' => [Times::tableName().'.price' => SORT_DESC]];
        $dataProvider->sort->attributes['placesSets_place'] = ['asc' => [PlacesSets::tableName().'.place' => SORT_ASC], 'desc' => [PlacesSets::tableName().'.place' => SORT_DESC]];
        $dataProvider->sort->attributes['placesSets_row'] = ['asc' => [PlacesSets::tableName().'.row' => SORT_ASC], 'desc' => [PlacesSets::tableName().'.row' => SORT_DESC]];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', Cities::tableName().'.name', $this->cities_name])
            ->andFilterWhere(['like', MovieTheaters::tableName().'.name', $this->movie_theaters_title])
            ->andFilterWhere(['like', Halls::tableName().'.name', $this->halls_name])
            ->andFilterWhere(['like', Movies::tableName().'.title', $this->movies_title])
            ->andFilterWhere(['like', Sessions::tableName().'.date', $this->sessions_date])
            ->andFilterWhere(['like', Times::tableName().'.time', $this->times_time])
            ->andFilterWhere(['like', Times::tableName().'.price', $this->times_price])
            ->andFilterWhere(['like', PlacesSets::tableName().'.place', $this->placesSets_place])
            ->andFilterWhere(['like', PlacesSets::tableName().'.row', $this->placesSets_row]);

        return $dataProvider;
    }
}
