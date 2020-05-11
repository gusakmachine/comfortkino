<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ads_pages".
 *
 * @property int $ads_id
 * @property int $pages_id
 *
 * @property Ads $ads
 * @property Pages $pages
 */
class AdsPages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ads_pages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ads_id', 'pages_id'], 'required'],
            [['ads_id', 'pages_id'], 'integer'],
            [['ads_id', 'pages_id'], 'unique', 'targetAttribute' => ['ads_id', 'pages_id']],
            [['ads_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ads::className(), 'targetAttribute' => ['ads_id' => 'id']],
            [['pages_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pages::className(), 'targetAttribute' => ['pages_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ads_id' => 'Ads ID',
            'pages_id' => 'Pages ID',
        ];
    }

    /**
     * Gets query for [[Ads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAds()
    {
        return $this->hasOne(Ads::className(), ['id' => 'ads_id']);
    }

    /**
     * Gets query for [[Pages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasOne(Pages::className(), ['id' => 'pages_id']);
    }
}
