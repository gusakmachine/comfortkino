<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "time".
 *
 * @property int $id
 * @property string|null $time
 *
 * @property SessionsTime[] $sessionsTimes
 * @property Sessions[] $sessions
 */
class Time extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'time';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time' => 'Time',
        ];
    }

    /**
     * Gets query for [[SessionsTimes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSessionsTimes()
    {
        return $this->hasMany(SessionsTime::className(), ['time_id' => 'id']);
    }

    /**
     * Gets query for [[Sessions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSessions()
    {
        return $this->hasMany(Sessions::className(), ['id' => 'sessions_id'])->viaTable('sessions_time', ['time_id' => 'id']);
    }
}
