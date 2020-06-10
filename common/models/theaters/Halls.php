<?php

namespace common\models\theaters;

use Yii;

/**
 * This is the model class for table "halls".
 *
 * @property int $id
 * @property int|null $capacity
 * @property int|null $movie_theaters_id
 * @property int|null $places_sets_id
 *
 * @property MovieTheaters $movieTheaters
 * @property Sessions[] $sessions
 * @property Tickets[] $tickets
 */
class Halls extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'halls';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['capacity', 'movie_theaters_id', 'places_sets_id'], 'integer'],
            [['movie_theaters_id'], 'exist', 'skipOnError' => true, 'targetClass' => MovieTheaters::className(), 'targetAttribute' => ['movie_theaters_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'capacity' => 'Capacity',
            'movie_theaters_id' => 'Movie Theaters ID',
            'places_sets_id' => 'Places Sets ID',
        ];
    }

    /**
     * Gets query for [[MovieTheaters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMovieTheaters()
    {
        return $this->hasOne(MovieTheaters::className(), ['id' => 'movie_theaters_id']);
    }

    /**
     * Gets query for [[Sessions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSessions()
    {
        return $this->hasMany(Sessions::className(), ['hall_id' => 'id']);
    }

    /**
     * Gets query for [[Tickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Tickets::className(), ['hall_id' => 'id']);
    }

    public static function loadPlaces($data) {
        $new_model = [];
        $set_id = intval(PlacesSets::find()->max('set_id')) + 1;

        foreach ($data as $key => $item)
            foreach ($item as $sub_key => $sub_item) {
                $model = new PlacesSets();
                $model->load(['PlacesSets' => [
                    'place' => $sub_key,
                    'row' => $key,
                    'graphic_display' => $sub_item['graphic_display'],
                    'set_id' => $set_id,
                    'price_id' => $sub_item['price_id'],
                    'color_id' => $sub_item['color_id'],
                ]]);
            }

        return $new_model;
    }

    public static function saveMultiple($models) {
        foreach ($models as $model)
            if (!$model->save())
                return false;

        return true;
    }
}
