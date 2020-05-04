<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "movies_countries".
 *
 * @property int $movies_id
 * @property int $countries_id
 *
 * @property Countries $countries
 * @property Movies $movies
 */
class MoviesCountries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'movies_countries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['movies_id', 'countries_id'], 'required'],
            [['movies_id', 'countries_id'], 'integer'],
            [['movies_id', 'countries_id'], 'unique', 'targetAttribute' => ['movies_id', 'countries_id']],
            [['countries_id'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['countries_id' => 'id']],
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
            'countries_id' => 'Countries ID',
        ];
    }

    /**
     * Gets query for [[Countries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountries()
    {
        return $this->hasOne(Countries::className(), ['id' => 'countries_id']);
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
