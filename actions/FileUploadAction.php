<?php

namespace minderm\redactor\actions;

use Yii;
use minderm\redactor\models\FileUploadModel;
use yii\helpers\Json;

class FileUploadAction extends \yii\base\Action {

    public $uploadDir = false;
    public $baseUrl = false;

    function run()
    {
        if (isset($_FILES)) {
            $model = new FileUploadModel([
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
