<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ads".
 *
 * @property int $id
 * @property string|null $render_file_name
 * @property int|null $page_pos
 * @property int|null $movie_theater_id
 * @property int|null $visibility
 * @property string|null $json_content
 * @property string $created_at
 * @property string $updated_at
 *
 * @property MovieTheaters $movieTheater
 * @property AdsPages[] $adsPages
 * @property Pages[] $pages
 */
class Ads extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['page_pos', 'movie_theater_id', 'visibility'], 'integer'],
            [['json_content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['render_file_name'], 'string', 'max' => 255],
            [['movie_theater_id'], 'exist', 'skipOnError' => true, 'targetClass' => MovieTheaters::className(), 'targetAttribute' => ['movie_theater_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'render_file_name' => 'Render File Name',
            'page_pos' => 'Page Pos',
            'movie_theater_id' => 'Movie Theater ID',
            'visibility' => 'Visibility',
            'json_content' => 'Json Content',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[MovieTheater]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMovieTheater()
    {
        return $this->hasOne(MovieTheaters::className(), ['id' => 'movie_theater_id']);
    }

    /**
     * Gets query for [[AdsPages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdsPages()
    {
        return $this->hasMany(AdsPages::className(), ['ads_id' => 'id']);
    }

    /**
     * Gets query for [[Pages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Pages::className(), ['id' => 'pages_id'])->viaTable('ads_pages', ['ads_id' => 'id']);
    }
}
