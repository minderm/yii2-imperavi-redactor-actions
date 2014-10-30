<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace minderm\redactor\actions;

use Yii;
use minderm\redactor\models\ImageUploadModel;
use yii\helpers\Json;

class ImageUploadAction extends \yii\base\Action {

    public $uploadDir = false;
    public $baseUrl = false;

    function run()
    {
        if (isset($_FILES)) {
            $model = new ImageUploadModel([
                'uploadDir' => $this->uploadDir ? $this->uploadDir : $this->controller->module->uploadDir,
                'baseUrl' => $this->baseUrl = $this->baseUrl ? $this->baseUrl : ($this->controller->module->uploadUrl ? $this->controller->module->uploadUrl : $this->baseUrl)
            ]);
            if ($model->upload()) {
                echo $model->toJson();
            } else {
                if ($model->firstErrors) {
                    echo Json::encode(['error' => $model->firstErrors[0]]);
                }
            }
        }
    }

}
