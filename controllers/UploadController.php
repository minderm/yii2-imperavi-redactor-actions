<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace minderm\redactor\controllers;

class UploadController extends \yii\web\Controller {

    public $enableCsrfValidation = false;

    public function actions()
    {
        return [
            'file' => \minderm\redactor\actions\FileUploadAction::className(),
            'image' => \minderm\redactor\actions\ImageUploadAction::className(),
            'imagejson' => \minderm\redactor\actions\ImageGetJsonAction::className()
        ];
    }

}
