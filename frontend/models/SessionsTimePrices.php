<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sessions_time_prices".
 *
 * @property int $sessions_id
 * @property int $time_prices_id
 *
 * @property Sessions $sessions
 * @property TimePrices $timePrices
 */
class SessionsTimePrices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sessions_time_prices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sessions_id', 'time_prices_id'], 'required'],
            [['sessions_id', 'time_prices_id'], 'integer'],
            [['sessions_id', 'time_prices_id'], 'unique', 'targetAttribute' => ['sessions_id', 'time_prices_id']],
            [['sessions_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sessions::className(), 'targetAttribute' => ['sessions_id' => 'id']],
            [['time_prices_id'], 'exist', 'skipOnError' => true, 'targetClass' => TimePrices::className(), 'targetAttribute' => ['time_prices_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sessions_id' => 'Sessions ID',
            'time_prices_id' => 'Time Prices ID',
        ];
    }

    /**
     * Gets query for [[Sessions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSessions()
    {
        return $this->hasOne(Sessions::className(), ['id' => 'sessions_id']);
    }

    /**
     * Gets query for [[TimePrices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTimePrices()
    {
        return $this->hasOne(TimePrices::className(), ['id' => 'time_prices_id']);
    }
}
