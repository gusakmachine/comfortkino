<?php

namespace common\models\ads;

use Yii;

use common\models\theaters\MovieTheaters;
/**
 * This is the model class for table "page_background".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $background_image_name
 * @property int|null $movie_theaters_id
 * @property string|null $end_date
 * @property string $created_at
 * @property string $updated_at
 *
 * @property MovieTheaters $movieTheaters
 */
class PageBackground extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page_background';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['movie_theaters_id'], 'integer'],
            [['end_date', 'created_at', 'updated_at'], 'safe'],
            [['name', 'background_image_name'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'background_image_name' => 'Background Image Name',
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
