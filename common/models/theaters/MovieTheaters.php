<?php

namespace common\models\theaters;

use Yii;

use common\models\sessions\Tickets;

/**
 * This is the model class for table "movie_theaters".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $address
 * @property string|null $subdomain_name
 * @property int|null $city_id
 *
 * @property Halls[] $halls
 * @property Cities $city
 * @property Tickets[] $tickets
 */
class MovieTheaters extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'movie_theaters';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_id'], 'integer'],
            [['name', 'address', 'subdomain_name'], 'string', 'max' => 255],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'subdomain_name' => 'Subdomain Name',
            'city_id' => 'City ID',
        ];
    }

    /**
     * Gets query for [[Halls]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHalls()
    {
        return $this->hasMany(Halls::className(), ['movie_theaters_id' => 'id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    /**
     * Gets query for [[Tickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Tickets::className(), ['movie_theaters_id' => 'id']);
    }
}
