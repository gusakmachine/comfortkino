<?php

namespace common\models\movies;

use Yii;

/**
 * This is the model class for table "gallery".
 *
 * @property int $id
 * @property string|null $image_name
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
            [['image_name'], 'string', 'max' => 255],
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
            'image_name' => 'Image Name',
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

    public static function loadImageFiles($id, $imageFiles, $exist_gallery_models = [])
    {
        $new_gallery_models = [];

        foreach ($imageFiles as $image) {
            if (is_object($image)) {
                foreach ($exist_gallery_models as $exist_gallery_model)
                    if ($exist_gallery_model->image_name == $image->name)
                        continue 2;

                $gallery_image = new Gallery();
                $gallery_image->load(['Gallery' => ['image_name' => $image->name, 'movies_id' => $id]]);
                $new_gallery_models[] = $gallery_image;
            }
        }

        return $new_gallery_models;
    }

    public static function saveMultiple($models) {
        foreach ($models as $model)
            if (!$model->save())
                return false;

        return true;
    }

    public static function deleteImageFiles($gallery_models, $to_delete_gallery_models) {
        $toDeleteImagesIDX = array_intersect($to_delete_gallery_models, array_column($gallery_models, 'id'));

        if (!empty($toDeleteImagesIDX))
            return Gallery::deleteAll(['id' => $toDeleteImagesIDX]);

        return false;
    }
}
