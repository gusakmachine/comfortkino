<?php

namespace common\models\movies;

use Yii;

/**
 * This is the model class for table "movies_directors".
 *
 * @property int $movies_id
 * @property int $directors_id
 *
 * @property Directors $directors
 * @property Movies $movies
 */
class MoviesDirectors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'movies_directors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['movies_id', 'directors_id'], 'required'],
            [['movies_id', 'directors_id'], 'integer'],
            [['movies_id', 'directors_id'], 'unique', 'targetAttribute' => ['movies_id', 'directors_id']],
            [['directors_id'], 'exist', 'skipOnError' => true, 'targetClass' => Directors::className(), 'targetAttribute' => ['directors_id' => 'id']],
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
            'directors_id' => 'Directors ID',
        ];
    }

    /**
     * Gets query for [[Directors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirectors()
    {
        return $this->hasOne(Directors::className(), ['id' => 'directors_id']);
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
