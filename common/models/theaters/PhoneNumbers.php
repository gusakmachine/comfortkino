<?php

namespace common\models\theaters;

use Yii;

/**
 * This is the model class for table "phone_numbers".
 *
 * @property int $id
 * @property string|null $phone
 * @property int|null $movie_theaters_id
 *
 * @property MovieTheaters $movieTheaters
 */
class PhoneNumbers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'phone_numbers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['movie_theaters_id'], 'integer'],
            [['phone'], 'string', 'max' => 255],
            [['movie_theaters_id'], 'exist', 'skipOnError' => true, 'targetClass' => MovieTheaters::className(), 'targetAttribute' => ['movie_theaters_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Phone',
            'movie_theaters_id' => 'Movie Theaters ID',
        ];
    }

    /**
     * Gets query for [[MovieTheaters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMovieTheaters()
    {
        return $this->hasOne(MovieTheaters::className(), ['id' => 'movie_theaters_id']);
    }

//    public function saveMultiple($movie_theater_id) {
//        for ($i = 0; $i < count($this->phones); $i++) {
//            $this->isNewRecord = true;
//            $this->movie_theaters_id = $movie_theater_id;
//            $this->phone = $this->phones[$i];
//            $this->save();
//            print_r($i);
//        }
//        return $this;
//    }

    /**
     * @param $phones
     * @param $movie_theater_id
     * @return bool
     */
    public static function saveMultiple($phones, $movie_theaters_id) {
        foreach ($phones as $phone) {
            $phone->movie_theaters_id = $movie_theaters_id;
            $phone->save();
        }
        return true;
    }
}
