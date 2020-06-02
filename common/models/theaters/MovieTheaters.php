<?php

namespace common\models\theaters;

use common\models\ads\BrandingNotes;
use common\models\ads\Notes;
use common\models\ads\OwlAds;
use common\models\ads\OwlMovies;
use common\models\ads\PageBackground;
use common\models\sessions\Tickets;
use Yii;

/**
 * This is the model class for table "movie_theaters".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $address
 * @property string|null $google_map_img
 * @property string|null $google_map_link
 * @property string|null $start_work_time
 * @property string|null $end_work_time
 * @property string|null $subdomain_name
 * @property int|null $city_id
 *
 * @property BrandingNotes[] $brandingNotes
 * @property Halls[] $halls
 * @property Cities $city
 * @property Notes[] $notes
 * @property OwlAds[] $owlAds
 * @property OwlMovies[] $owlMovies
 * @property PageBackground[] $pageBackgrounds
 * @property PhoneNumbers[] $phoneNumbers
 * @property Socials[] $socials
 * @property Tickets[] $tickets
 */
class MovieTheaters extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'movie_theaters';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'address', 'google_map_img', 'google_map_link', 'start_work_time', 'end_work_time', 'subdomain_name'], 'required'],
            [['start_work_time', 'end_work_time'], 'safe'],
            [['city_id'], 'integer'],
            [['name', 'address', 'google_map_img', 'subdomain_name'], 'string', 'max' => 255],
            [['google_map_link'], 'string', 'max' => 512],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'id']],
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
            'address' => 'Address',
            'google-map-img' => 'Google Map Img',
            'google-map-link' => 'Google Map Link',
            'start_work_time' => 'Start Work Time',
            'end_work_time' => 'End Work Time',
            'subdomain_name' => 'Subdomain Name',
            'city_id' => 'City ID',
        ];
    }

    /**
     * Gets query for [[BrandingNotes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBrandingNotes()
    {
        return $this->hasMany(BrandingNotes::className(), ['movie_theaters_id' => 'id']);
    }

    /**
     * Gets query for [[Halls]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHalls()
    {
        return $this->hasMany(Halls::className(), ['movie_theaters_id' => 'id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    /**
     * Gets query for [[Notes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotes()
    {
        return $this->hasMany(Notes::className(), ['movie_theaters_id' => 'id']);
    }

    /**
     * Gets query for [[OwlAds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOwlAds()
    {
        return $this->hasMany(OwlAds::className(), ['movie_theaters_id' => 'id']);
    }

    /**
     * Gets query for [[OwlMovies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOwlMovies()
    {
        return $this->hasMany(OwlMovies::className(), ['movie_theaters_id' => 'id']);
    }

    /**
     * Gets query for [[PageBackgrounds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPageBackgrounds()
    {
        return $this->hasMany(PageBackground::className(), ['movie_theaters_id' => 'id']);
    }

    /**
     * Gets query for [[PhoneNumbers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhoneNumbers()
    {
        return $this->hasMany(PhoneNumbers::className(), ['movie_theaters_id' => 'id']);
    }

    /**
     * Gets query for [[Socials]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSocials()
    {
        return $this->hasMany(Socials::className(), ['movie_theaters_id' => 'id']);
    }

    /**
     * Gets query for [[Tickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Tickets::className(), ['movie_theaters_id' => 'id']);
    }
}
