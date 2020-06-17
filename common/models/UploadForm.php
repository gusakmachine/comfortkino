<?php

namespace common\models;

use Yii;
use yii\base\Model;

class UploadForm extends Model
{
    public $imageFiles;
    public $dirname;

    public function rules()
    {
        return [
            [['dirname'], 'safe'],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'svg, jpg, jpeg, png', 'maxFiles' => 10],
        ];
    }

    public function upload()
    {
        $this->dirname = $this->prepareDirname();
        if ($this->validate()) {
            foreach ($this->imageFiles as $file) {
                if (is_array($file)) {
                    $this->dirname = $file['dirname'] ? $this->prepareDirname($file['dirname']) : $this->prepareDirname('/img/');
                    foreach ($file as $item) {
                        $this->saveFile($item);
                    }
                } else {
                    $this->saveFile($file);
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function prepareDirname($dirname = null) {
        $dirname = $dirname ? $dirname : $this->dirname;
        return Yii::getAlias('@frontend/web/') . $dirname;
    }

    public function saveFile($file) {
        if (is_object($file)) {
            if (!is_dir($this->dirname)) {
                mkdir($this->dirname, 0777, true);
            }
            return $file->saveAs($this->dirname . $file->baseName . '.' . $file->extension);
        }
        return false;
    }
}