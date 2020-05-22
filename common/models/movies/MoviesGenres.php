<?php

namespace common\models\movies;

use Yii;

/**
 * This is the model class for table "movies_genres".
 *
 * @property int $movies_id
 * @property int $genres_id
 *
 * @property Genres $genres
 * @property Movies $movies
 */
class MoviesGenres extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'movies_genres';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['movies_id', 'genres_id'], 'required'],
            [['movies_id', 'genres_id'], 'integer'],
            [['movies_id', 'genres_id'], 'unique', 'targetAttribute' => ['movies_id', 'genres_id']],
            [['genres_id'], 'exist', 'skipOnError' => true, 'targetClass' => Genres::className(), 'targetAttribute' => ['genres_id' => 'id']],
            [['movies_id'], 'exist', 'skipOnError' => true, 'targetClass' => Movies::className(), 'targetAttribute' => ['movies_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'movies_id' => 'Movies ID',
            'genres_id' => 'Genres ID',
        ];
    }

    /**
     * Gets query for [[Genres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenres()
    {
        return $this->hasOne(Genres::className(), ['id' => 'genres_id']);
    }

    /**
     * Gets query for [[Movies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMovies()
    {
        return $this->hasOne(Movies::className(), ['id' => 'movies_id']);
    }
}
