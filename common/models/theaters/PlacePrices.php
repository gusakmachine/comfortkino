<?php

namespace common\models\theaters;

use Yii;

/**
 * This is the model class for table "place_prices".
 *
 * @property int $id
 * @property int|null $price
 *
 * @property PlacesSets[] $placesSets
 */
class PlacePrices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'place_prices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'price' => 'Price',
        ];
    }

    /**
     * Gets query for [[PlacesSets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlacesSets()
    {
        return $this->hasMany(PlacesSets::className(), ['price_id' => 'id']);
    }
}
