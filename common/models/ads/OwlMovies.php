<?php

namespace common\models\ads;

use Yii;

use common\models\theaters\MovieTheaters;
use common\models\movies\Movies;
/**
 * This is the model class for table "owl_movies".
 *
 * @property int $id
 * @property int|null $movie_id
 * @property int|null $movie_theaters_id
 * @property string|null $end_date
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Movies $movie
 * @property MovieTheaters $movieTheaters
 */
class OwlMovies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'owl_movies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['movie_id', 'movie_theaters_id'], 'integer'],
            [['end_date', 'created_at', 'updated_at'], 'safe'],
            [['movie_id'], 'exist', 'skipOnError' => true, 'targetClass' => Movies::className(), 'targetAttribute' => ['movie_id' => 'id']],
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
            'movie_id' => 'Movie ID',
            'movie_theaters_id' => 'Movie Theaters ID',
            'end_date' => 'End Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
}
