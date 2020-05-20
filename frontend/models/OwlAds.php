<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "owl_ads".
 *
 * @property int $id
 * @property string|null $subtitle
 * @property string|null $title
 * @property string|null $background_image
 * @property string|null $button_text
 * @property int|null $movie_theaters_id
 * @property string|null $end_date
 * @property string $created_at
 * @property string $updated_at
 *
 * @property MovieTheaters $movieTheaters
 */
class OwlAds extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'owl_ads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['movie_theaters_id'], 'integer'],
            [['end_date', 'created_at', 'updated_at'], 'safe'],
            [['subtitle', 'title', 'background_image', 'button_text'], 'string', 'max' => 255],
            [['movie_theaters_id'], 'exist', 'skipOnError' => true, 'targetClass' => MovieTheaters::className(), 'targetAttribute' => ['movie_theaters_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subtitle' => 'Subtitle',
            'title' => 'Title',
            'background_image' => 'Background Image',
            'button_text' => 'Button Text',
            'movie_theaters_id' => 'Movie Theaters ID',
            'end_date' => 'End Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[MovieTheaters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMovieTheaters()
    {
        return $this->hasOne(MovieTheaters::className(), ['id' => 'movie_theaters_id']);
    }
}
