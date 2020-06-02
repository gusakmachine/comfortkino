<?php

namespace common\models;

use yii\base\Model;

class UploadForm extends Model
{
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'svg, jpg, jpeg, png', 'maxFiles' => 10],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            /*foreach ($this->imageFiles as $file) {
                if (is_array($file))
                    foreach ($file as $item)
                        $item->saveAs($item->baseName . '.' . $item->extension);
                else $file->saveAs($file->baseName . '.' . $file->extension);
            }*/
            return true;
        } else {
            return false;
        }
    }
}