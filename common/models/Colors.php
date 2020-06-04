<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "colors".
 *
 * @property int $id
 * @property string|null $color
 *
 * @property AllowedBackgroundColors[] $allowedBackgroundColors
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
            [['color'], 'unique'],
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
     * Gets query for [[AllowedBackgroundColors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAllowedBackgroundColors()
    {
        return $this->hasMany(AllowedBackgroundColors::className(), ['color_id' => 'id']);
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
