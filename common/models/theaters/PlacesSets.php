<?php

namespace common\models\theaters;

use Yii;

use common\models\sessions\Tickets;
use common\models\Colors;

/**
 * This is the model class for table "places_sets".
 *
 * @property int $id
 * @property int|null $place
 * @property int|null $row
 * @property string|null $graphic_display
 * @property int|null $set_id
 * @property int|null $price_id
 * @property int|null $color_id
 *
 * @property HallsPlacesSets[] $hallsPlacesSets
 * @property Halls[] $halls
 * @property Colors $color
 * @property PlacePrices $price
 * @property Tickets[] $tickets
 */
class PlacesSets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'places_sets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['place', 'row', 'set_id', 'price_id', 'color_id'], 'integer'],
            [['graphic_display'], 'string'],
            [['color_id'], 'exist', 'skipOnError' => true, 'targetClass' => Colors::className(), 'targetAttribute' => ['color_id' => 'id']],
            [['price_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlacePrices::className(), 'targetAttribute' => ['price_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'place' => 'Place',
            'row' => 'Row',
            'graphic_display' => 'Graphic Display',
            'set_id' => 'Set ID',
            'price_id' => 'Price ID',
            'color_id' => 'Color ID',
        ];
    }

    /**
     * Gets query for [[HallsPlacesSets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHallsPlacesSets()
    {
        return $this->hasMany(HallsPlacesSets::className(), ['places_sets_id' => 'set_id']);
    }

    /**
     * Gets query for [[Halls]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHalls()
    {
        return $this->hasMany(Halls::className(), ['id' => 'halls_id'])->viaTable('halls_places_sets', ['places_sets_id' => 'set_id']);
    }

    /**
     * Gets query for [[Color]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getColors()
    {
        return $this->hasOne(Colors::className(), ['id' => 'color_id']);
    }

    /**
     * Gets query for [[Price]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlacePrice()
    {
        return $this->hasOne(PlacePrices::className(), ['id' => 'price_id']);
    }

    /**
     * Gets query for [[Tickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasOne(Tickets::className(), ['place_id' => 'id']);
    }
}