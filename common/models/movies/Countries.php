<?php

namespace common\models\movies;

use Yii;

/**
 * This is the model class for table "countries".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property MoviesCountries[] $moviesCountries
 * @property Movies[] $movies
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'countries';
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
     * Gets query for [[MoviesCountries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMoviesCountries()
    {
        return $this->hasMany(MoviesCountries::className(), ['countries_id' => 'id']);
    }

    /**
     * Gets query for [[Movies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMovies()
    {
        return $this->hasMany(Movies::className(), ['id' => 'movies_id'])->viaTable('movies_countries', ['countries_id' => 'id']);
    }
}
