<?php

namespace common\models\movies;

use Yii;
use yii\helpers\ArrayHelper;
use zxbodya\yii2\galleryManager\GalleryBehavior;

/**
 * This is the model class for table "movies".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $duration
 * @property int|null $age
 * @property string|null $poster
 * @property string|null $mob_poster
 * @property string|null $trailer
 * @property string|null $release_date
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Gallery[] $galleries
 * @property MoviesActors[] $moviesActors
 * @property Actors[] $actors
 * @property MoviesCountries[] $moviesCountries
 * @property Countries[] $countries
 * @property MoviesDirectors[] $moviesDirectors
 * @property Directors[] $directors
 * @property MoviesGenres[] $moviesGenres
 * @property Genres[] $genres
 * @property OwlMovies[] $owlMovies
 * @property Sessions[] $sessions
 * @property Tickets[] $tickets
 */
class Movies extends \yii\db\ActiveRecord
{
    public $file_poster;
    public $file_mob_poster;
    public $files_gallery;

    public $actors;
    public $directors;
    public $genres;
    public $countries;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'movies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['duration', 'release_date', 'created_at', 'updated_at'], 'safe'],
            [['age'], 'integer'],
            [['title', 'poster', 'mob_poster', 'trailer'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'duration' => 'Duration',
            'age' => 'Age',
            'poster' => 'Poster',
            'mob_poster' => 'Mob Poster',
            'trailer' => 'Trailer',
            'release_date' => 'Release Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Galleries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGallery()
    {
        return $this->hasMany(Gallery::className(), ['movies_id' => 'id']);
    }

    /**
     * Gets query for [[MoviesActors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMoviesActors()
    {
        return $this->hasMany(MoviesActors::className(), ['movies_id' => 'id']);
    }

    /**
     * Gets query for [[Actors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getActors()
    {
        return $this->hasMany(Actors::className(), ['id' => 'actors_id'])->viaTable('movies_actors', ['movies_id' => 'id']);
    }

    /**
     * Gets query for [[MoviesCountries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMoviesCountries()
    {
        return $this->hasMany(MoviesCountries::className(), ['movies_id' => 'id']);
    }

    /**
     * Gets query for [[Countries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountries()
    {
        return $this->hasMany(Countries::className(), ['id' => 'countries_id'])->viaTable('movies_countries', ['movies_id' => 'id']);
    }

    /**
     * Gets query for [[MoviesDirectors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMoviesDirectors()
    {
        return $this->hasMany(MoviesDirectors::className(), ['movies_id' => 'id']);
    }

    /**
     * Gets query for [[Directors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirectors()
    {
        return $this->hasMany(Directors::className(), ['id' => 'directors_id'])->viaTable('movies_directors', ['movies_id' => 'id']);
    }

    /**
     * Gets query for [[MoviesGenres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMoviesGenres()
    {
        return $this->hasMany(MoviesGenres::className(), ['movies_id' => 'id']);
    }

    /**
     * Gets query for [[Genres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenres()
    {
        return $this->hasMany(Genres::className(), ['id' => 'genres_id'])->viaTable('movies_genres', ['movies_id' => 'id']);
    }

    /**
     * Gets query for [[OwlMovies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOwlMovies()
    {
        return $this->hasMany(OwlMovies::className(), ['movie_id' => 'id']);
    }

    /**
     * Gets query for [[Sessions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSessions()
    {
        return $this->hasMany(Sessions::className(), ['movie_id' => 'id']);
    }

    /**
     * Gets query for [[Tickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Tickets::className(), ['movie_id' => 'id']);
    }
}
