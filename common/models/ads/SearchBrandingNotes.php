<?php

namespace common\models\ads;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ads\BrandingNotes;

/**
 * SearchBrandingNotes represents the model behind the search form of `common\models\ads\BrandingNotes`.
 */
class SearchBrandingNotes extends BrandingNotes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'movie_theaters_id'], 'integer'],
            [['text', 'link-text', 'svg_image_name', 'href', 'end_date', 'created_at', 'updated_at'], 'safe'],
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
        $query = BrandingNotes::find();

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
            'movie_theaters_id' => $this->movie_theaters_id,
            'end_date' => $this->end_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'link-text', $this->link-text])
            ->andFilterWhere(['like', 'svg_image_name', $this->svg_image_name])
            ->andFilterWhere(['like', 'href', $this->href]);

        return $dataProvider;
    }
}
