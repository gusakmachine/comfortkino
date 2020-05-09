<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "halls_places_sets".
 *
 * @property int $halls_id
 * @property int $places_sets_id
 *
 * @property Halls $halls
 * @property PlacesSets $placesSets
 */
class HallsPlacesSets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'halls_places_sets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['halls_id', 'places_sets_id'], 'required'],
            [['halls_id', 'places_sets_id'], 'integer'],
            [['halls_id', 'places_sets_id'], 'unique', 'targetAttribute' => ['halls_id', 'places_sets_id']],
            [['halls_id'], 'exist', 'skipOnError' => true, 'targetClass' => Halls::className(), 'targetAttribute' => ['halls_id' => 'id']],
            [['places_sets_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlacesSets::className(), 'targetAttribute' => ['places_sets_id' => 'set_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'halls_id' => 'Halls ID',
            'places_sets_id' => 'Places Sets ID',
        ];
    }

    /**
     * Gets query for [[Halls]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHalls()
    {
        return $this->hasOne(Halls::className(), ['id' => 'halls_id']);
    }

    /**
     * Gets query for [[PlacesSets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlacesSets()
    {
        return $this->hasOne(PlacesSets::className(), ['set_id' => 'places_sets_id']);
    }
}
