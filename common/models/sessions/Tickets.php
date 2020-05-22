<?php

namespace common\models\sessions;

use Yii;

use common\models\theaters\Cities;
use common\models\theaters\Halls;
use common\models\movies\Movies;
use common\models\theaters\MovieTheaters;
use common\models\theaters\PlacesSets;

/**
 * This is the model class for table "tickets".
 *
 * @property int $id
 * @property int|null $full_price
 * @property int|null $sessions_id
 * @property int|null $place_id
 * @property int|null $movie_id
 * @property int|null $hall_id
 * @property int|null $movie_theaters_id
 * @property int|null $city_id
 * @property int|null $time_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Cities $city
 * @property Halls $hall
 * @property Movies $movie
 * @property MovieTheaters $movieTheaters
 * @property PlacesSets $place
 * @property Sessions $sessions
 * @property Time $time
 */
class Tickets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tickets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_price', 'sessions_id', 'place_id', 'movie_id', 'hall_id', 'movie_theaters_id', 'city_id', 'time_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['hall_id'], 'exist', 'skipOnError' => true, 'targetClass' => Halls::className(), 'targetAttribute' => ['hall_id' => 'id']],
            [['movie_id'], 'exist', 'skipOnError' => true, 'targetClass' => Movies::className(), 'targetAttribute' => ['movie_id' => 'id']],
            [['movie_theaters_id'], 'exist', 'skipOnError' => true, 'targetClass' => MovieTheaters::className(), 'targetAttribute' => ['movie_theaters_id' => 'id']],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlacesSets::className(), 'targetAttribute' => ['place_id' => 'id']],
            [['sessions_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sessions::className(), 'targetAttribute' => ['sessions_id' => 'id']],
            [['time_id'], 'exist', 'skipOnError' => true, 'targetClass' => Time::className(), 'targetAttribute' => ['time_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_price' => 'Full Price',
            'sessions_id' => 'Sessions ID',
            'place_id' => 'Place ID',
            'movie_id' => 'Movie ID',
            'hall_id' => 'Hall ID',
            'movie_theaters_id' => 'Movie Theaters ID',
            'city_id' => 'City ID',
            'time_id' => 'Time ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    /**
     * Gets query for [[Hall]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHall()
    {
        return $this->hasOne(Halls::className(), ['id' => 'hall_id']);
    }

    /**
     * Gets query for [[Movie]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMovie()
    {
        return $this->hasOne(Movies::className(), ['id' => 'movie_id']);
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
     * Gets query for [[Place]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlace()
    {
        return $this->hasOne(PlacesSets::className(), ['id' => 'place_id']);
    }

    /**
     * Gets query for [[Sessions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSessions()
    {
        return $this->hasOne(Sessions::className(), ['id' => 'sessions_id']);
    }

    /**
     * Gets query for [[Time]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTime()
    {
        return $this->hasOne(Time::className(), ['id' => 'time_id']);
    }
}
