<?php

namespace common\models\theaters;

use common\models\sessions\Tickets;
use common\models\theaters\PlacePrices;
use Yii;
use common\models\Colors;
use common\models\theaters\Halls;

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
     * Gets query for [[Halls]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHalls()
    {
        return $this->hasMany(Halls::className(), ['places_sets_id' => 'id']);
    }

    /**
     * Gets query for [[Color]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getColor()
    {
        return $this->hasOne(Colors::className(), ['id' => 'color_id']);
    }

    /**
     * Gets query for [[Price]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrice()
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
        return $this->hasMany(Tickets::className(), ['place_id' => 'id']);
    }

    public static function loadPlaces($placesSets, $set_id = false)
    {
        $new_models = [];

        if (!$set_id)
            $set_id = intval(PlacesSets::find()->max('set_id')) + 1;

        foreach ($placesSets as $row => $placeSet)
            foreach ($placeSet as $placeKey => $place) {
                $model = new PlacesSets();
                $model->load(['PlacesSets' => [
                    'place' => $placeKey,
                    'row' => $row,
                    'graphic_display' => $place['graphic_display'],
                    'set_id' => $set_id,
                    'price_id' => $place['price_id'],
                    'color_id' => $place['color_id'],
                ]]);
                $new_models[] = $model;
            }

        return $new_models;
    }

    public static function saveMultiple($models) {
        foreach ($models as $model)
            if (!$model->save())
                return false;

        return true;
    }

    public static function getSet($id) {
        $places = PlacesSets::find()->where(['set_id' => $id])->orderBy('row, place')->asArray()->all();

        for ($i = 0; $i < count($places); $i++) {
            $places[$i]['price_id'] = PlacePrices::find()->where(['id' => $places[$i]['price_id']])->one();
            $places[$i]['color_id'] = Colors::find()->where(['id' => $places[$i]['color_id']])->one();
        }

        return $places;
    }
}
