<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sessions_time".
 *
 * @property int $sessions_id
 * @property int $time_id
 *
 * @property Sessions $sessions
 * @property Time $time
 */
class SessionsTime extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sessions_time';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sessions_id', 'time_id'], 'required'],
            [['sessions_id', 'time_id'], 'integer'],
            [['sessions_id', 'time_id'], 'unique', 'targetAttribute' => ['sessions_id', 'time_id']],
            [['sessions_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sessions::className(), 'targetAttribute' => ['sessions_id' => 'id']],
            [['time_id'], 'exist', 'skipOnError' => true, 'targetClass' => Time::className(), 'targetAttribute' => ['time_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sessions_id' => 'Sessions ID',
            'time_id' => 'Time ID',
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
     * Gets query for [[Time]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTime()
    {
        return $this->hasOne(Time::className(), ['id' => 'time_id']);
    }
}
