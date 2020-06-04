<?php

namespace common\models\movies;

use Yii;

/**
 * This is the model class for table "movies_actors".
 *
 * @property int $movies_id
 * @property int $actors_id
 *
 * @property Actors $actors
 * @property Movies $movies
 */
class MoviesActors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'movies_actors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['movies_id', 'actors_id'], 'required'],
            [['movies_id', 'actors_id'], 'integer'],
            [['movies_id', 'actors_id'], 'unique', 'targetAttribute' => ['movies_id', 'actors_id']],
            [['actors_id'], 'exist', 'skipOnError' => true, 'targetClass' => Actors::className(), 'targetAttribute' => ['actors_id' => 'id']],
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
            'actors_id' => 'Actors ID',
        ];
    }

    /**
     * Gets query for [[Actors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getActors()
    {
        return $this->hasOne(Actors::className(), ['id' => 'actors_id']);
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

    public static function loadActors($movie_id, $data)
    {
        $new_actors = [];

        foreach ($data as $item) {
            $actor = new MoviesActors();
            $actor->load(['MoviesActors' => ['actors_id' => $item, 'movies_id' => $movie_id]]);
            $new_actors[] = $actor;
        }

        return $new_actors;
    }

    public static function saveMultiple($models) {
        foreach ($models as $model)
            if (!$model->save())
                return false;

        return true;
    }
}
