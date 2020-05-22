<?php

namespace common\models\movies;

use Yii;

/**
 * This is the model class for table "actors".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property MoviesActors[] $moviesActors
 * @property Movies[] $movies
 */
class Actors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'actors';
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
     * Gets query for [[MoviesActors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMoviesActors()
    {
        return $this->hasMany(MoviesActors::className(), ['actors_id' => 'id']);
    }

    /**
     * Gets query for [[Movies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMovies()
    {
        return $this->hasMany(Movies::className(), ['id' => 'movies_id'])->viaTable('movies_actors', ['actors_id' => 'id']);
    }
}
