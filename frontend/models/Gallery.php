<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gallery".
 *
 * @property int $id
 * @property string|null $path
 * @property int|null $movies_id
 *
 * @property Movies $movies
 */
class Gallery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['movies_id'], 'integer'],
            [['path'], 'string', 'max' => 255],
            [['movies_id'], 'exist', 'skipOnError' => true, 'targetClass' => Movies::className(), 'targetAttribute' => ['movies_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Path',
            'movies_id' => 'Movies ID',
        ];
    }

    /**
     * Gets query for [[Movies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMovies()
    {
        return $this->hasOne(Movies::className(), ['id' => 'movies_id']);
    }
}
