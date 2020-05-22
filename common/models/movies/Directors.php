<?php

namespace common\models\movies;

use Yii;

/**
 * This is the model class for table "directors".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property MoviesDirectors[] $moviesDirectors
 * @property Movies[] $movies
 */
class Directors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'directors';
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
     * Gets query for [[MoviesDirectors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMoviesDirectors()
    {
        return $this->hasMany(MoviesDirectors::className(), ['directors_id' => 'id']);
    }

    /**
     * Gets query for [[Movies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMovies()
    {
        return $this->hasMany(Movies::className(), ['id' => 'movies_id'])->viaTable('movies_directors', ['directors_id' => 'id']);
    }
}
