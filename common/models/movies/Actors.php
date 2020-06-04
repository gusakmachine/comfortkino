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
            [['name'], 'unique'],
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

    public static function loadImageFiles($id, $imageFiles, $exist_gallery_models)
    {
        $new_gallery_models = [];

        foreach ($imageFiles as $image) {
            foreach ($exist_gallery_models as $exist_gallery_model)
                if ($exist_gallery_model->image_name == $image->name)
                    continue 2;

            $gallery_image = new Gallery();
            $gallery_image->load(['Gallery' => ['image_name' => $image->name, 'movies_id' => $id]]);
            $new_gallery_models[] = $gallery_image;
        }

        return $new_gallery_models;
    }

    public static function saveMultiple($models) {
        foreach ($models as $model)
            if (!$model->save())
                return false;

        return true;
    }
}
