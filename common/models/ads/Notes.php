<?php

namespace common\models\ads;

use Yii;
use common\models\theaters\MovieTheaters;
/**
 * This is the model class for table "notes".
 *
 * @property int $id
 * @property string|null $text
 * @property string $svg_image_name
 * @property string $background_color
 * @property int|null $movie_theaters_id
 * @property string|null $end_date
 * @property string $created_at
 * @property string $updated_at
 *
 * @property MovieTheaters $movieTheaters
 */
class Notes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['svg_image_name', 'background_color'], 'required'],
            [['movie_theaters_id'], 'integer'],
            [['end_date', 'created_at', 'updated_at'], 'safe'],
            [['text', 'svg_image_name', 'background_color'], 'string', 'max' => 255],
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
            'text' => 'Text',
            'svg_image_name' => 'Svg Image Name',
            'background_color' => 'Background Color',
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
