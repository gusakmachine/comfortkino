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
            [['place', 'row', 'set_id', 'price'], 'integer'],
            [['graphic_display', 'color'], 'string'],
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
            'price' => 'Price',
            'color_id' => 'Color ID',
        ];
    }

    public static function getPlaceWithPrice($place_id) {
        return PlacesSets::find()->with('price')->where(['id' => $place_id])->asArray()->one();
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
                    'price' => $place['price'],
                    'color' => $place['color'],
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

    public static function getSet($param) {
        $tickets = Tickets::find()->select('place_id')->where([
            'and',
            [
                'status' => [0, 1],
                'sessions_id' => $param['session']['id'],
                'movie_id' => $param['session']['movie_id'],
                'hall_id' => $param['session']['hall_id'],
                'times_id' => $param['sessionTimeIDX']
            ]
        ])->asArray()->all();
        $places = PlacesSets::find()->where(['set_id' => $param['hall']['places_sets_id']])->orderBy('row, place')->asArray()->all();

        for ($i = 0; $i < count($places); $i++) {
            if (in_array($places[$i]['id'], array_column($tickets, 'place_id')))
                $places[$i]['isSold'] = true;
            else $places[$i]['isSold'] = false;
        }

        return $places;
    }
}
