<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "genres".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property MoviesGenres[] $moviesGenres
 * @property Movies[] $movies
 */
class Genres extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'genres';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[MoviesGenres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMoviesGenres()
    {
        return $this->hasMany(MoviesGenres::className(), ['genres_id' => 'id']);
    }

    /**
     * Gets query for [[Movies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMovies()
    {
        return $this->hasMany(Movies::className(), ['id' => 'movies_id'])->viaTable('movies_genres', ['genres_id' => 'id']);
    }
}
