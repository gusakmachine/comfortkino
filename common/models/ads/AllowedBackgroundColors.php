<?php

namespace common\models\ads;

use Yii;
use common\models\Colors;

/**
 * This is the model class for table "allowed_background_colors".
 *
 * @property int $id
 * @property int|null $color_id
 *
 * @property Colors $color
 */
class AllowedBackgroundColors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'allowed_background_colors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color_id'], 'integer'],
            [['color_id'], 'exist', 'skipOnError' => true, 'targetClass' => Colors::className(), 'targetAttribute' => ['color_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color_id' => 'Color ID',
        ];
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
}
