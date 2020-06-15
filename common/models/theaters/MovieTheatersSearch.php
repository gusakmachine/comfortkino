<?php

namespace common\models\theaters;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ActorsSearch represents the model behind the search form of `common\models\movies\Actors`.
 */
class MovieTheatersSearch extends MovieTheaters
{
    public $city;
    public $phoneNumbers;
    public $vk;
    public $facebook;
    public $instagram;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'address', 'start_work_time', 'end_work_time', 'subdomain_name', 'city', 'phoneNumbers', 'vk', 'facebook', 'instagram'], 'safe'],
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
        $query = MovieTheaters::find();
        $query->joinWith(['city', 'phoneNumbers', 'socials']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['city'] = [
            'asc' => [Cities::tableName().'.name' => SORT_ASC],
            'desc' => [Cities::tableName().'.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['phoneNumbers'] = [
            'asc' => [PhoneNumbers::tableName().'.phone' => SORT_ASC],
            'desc' => [PhoneNumbers::tableName().'.phone' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['vk'] = [
            'asc' => [Socials::tableName().'.vk' => SORT_ASC],
            'desc' => [Socials::tableName().'.vk' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['facebook'] = [
            'asc' => [Socials::tableName().'.facebook' => SORT_ASC],
            'desc' => [Socials::tableName().'.facebook' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['instagram'] = [
            'asc' => [Socials::tableName().'.instagram' => SORT_ASC],
            'desc' => [Socials::tableName().'.instagram' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', MovieTheaters::tableName().'.name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'start_work_time', $this->start_work_time])
            ->andFilterWhere(['like', 'end_work_time', $this->end_work_time])
            ->andFilterWhere(['like', 'subdomain_name', $this->subdomain_name])
            ->andFilterWhere(['like', Socials::tableName().'.vk', $this->vk])
            ->andFilterWhere(['like', Socials::tableName().'.facebook', $this->facebook])
            ->andFilterWhere(['like', Socials::tableName().'.instagram', $this->instagram])
            ->andFilterWhere(['like', PhoneNumbers::tableName().'.phone', $this->phoneNumbers])
            ->andFilterWhere(['like', Cities::tableName().'.name', $this->city]);

        return $dataProvider;
    }
}
