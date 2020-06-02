<?php

namespace common\models\sessions;

use Yii;

/**
 * This is the model class for table "times".
 *
 * @property int $id
 * @property string|null $time
 * @property int|null $price
 * @property int|null $sessions_id
 *
 * @property Tickets[] $tickets
 * @property Sessions $sessions
 */
class Times extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'times';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['time', 'price'], 'safe'],
            [['sessions_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sessions::className(), 'targetAttribute' => ['sessions_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time' => 'time',
            'price' => 'price',
            'sessions_id' => 'Sessions ID',
        ];
    }

    /**
     * Gets query for [[Tickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Tickets::className(), ['times_id' => 'id']);
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
     * @param $times
     * @param $sessions_id
     * @return bool
     */
    public static function saveMultiple($times, $sessions_id) {
        foreach ($times as $time) {
            $time->sessions_id = $sessions_id;
            $time->save();
        }
        return true;
    }

}
