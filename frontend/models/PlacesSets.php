<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "places_sets".
 *
 * @property int $id
 * @property int|null $place
 * @property int|null $row
 * @property int|null $graphic_place
 * @property int|null $graphic_row
 * @property int|null $price
 * @property int|null $set_id
 *
 * @property HallsPlacesSets[] $hallsPlacesSets
 * @property Halls[] $halls
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
            [['place', 'row', 'graphic_place', 'graphic_row', 'price', 'set_id'], 'integer'],
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
            'graphic_place' => 'Graphic Place',
            'graphic_row' => 'Graphic Row',
            'price' => 'Price',
            'set_id' => 'Set ID',
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
     * Gets query for [[Tickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Tickets::className(), ['place_id' => 'id']);
    }
}
