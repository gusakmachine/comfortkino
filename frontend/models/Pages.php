<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property AdsPages[] $adsPages
 * @property Ads[] $ads
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pages';
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
     * Gets query for [[AdsPages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdsPages()
    {
        return $this->hasMany(AdsPages::className(), ['pages_id' => 'id']);
    }

    /**
     * Gets query for [[Ads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAds()
    {
        return $this->hasMany(Ads::className(), ['id' => 'ads_id'])->viaTable('ads_pages', ['pages_id' => 'id']);
    }
}
