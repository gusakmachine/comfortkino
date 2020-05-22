<?php

namespace common\models\theaters;

use Yii;

use common\models\sessions\Sessions;
use common\models\sessions\Tickets;

/**
 * This is the model class for table "halls".
 *
 * @property int $id
 * @property int|null $capacity
 * @property int|null $movie_theaters_id
 *
 * @property MovieTheaters $movieTheaters
 * @property HallsPlacesSets[] $hallsPlacesSets
 * @property PlacesSets[] $placesSets
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
            [['capacity', 'movie_theaters_id'], 'integer'],
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
     * Gets query for [[HallsPlacesSets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHallsPlacesSets()
    {
        return $this->hasMany(HallsPlacesSets::className(), ['halls_id' => 'id']);
    }

    /**
     * Gets query for [[PlacesSets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlacesSets()
    {
        return $this->hasMany(PlacesSets::className(), ['set_id' => 'places_sets_id'])->viaTable('halls_places_sets', ['halls_id' => 'id']);
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
}
