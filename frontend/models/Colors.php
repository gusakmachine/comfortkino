<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "colors".
 *
 * @property int $id
 * @property string|null $color
 *
 * @property PlacesSets[] $placesSets
 */
class Colors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'colors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Color',
        ];
    }

    /**
     * Gets query for [[PlacesSets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlacesSets()
    {
        return $this->hasMany(PlacesSets::className(), ['color_id' => 'id']);
    }
}
