<?php

namespace common\models\sessions;

use Yii;

/**
 * This is the model class for table "time_prices".
 *
 * @property int $id
 * @property int|null $price
 *
 * @property SessionsTimePrices[] $sessionsTimePrices
 * @property Sessions[] $sessions
 */
class TimePrices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'time_prices';
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
     * Gets query for [[SessionsTimePrices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSessionsTimePrices()
    {
        return $this->hasMany(SessionsTimePrices::className(), ['time_prices_id' => 'id']);
    }

    /**
     * Gets query for [[Sessions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSessions()
    {
        return $this->hasMany(Sessions::className(), ['id' => 'sessions_id'])->viaTable('sessions_time_prices', ['time_prices_id' => 'id']);
    }
}
