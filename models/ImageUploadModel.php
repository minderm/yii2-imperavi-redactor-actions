<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace minderm\redactor\models;

class ImageUploadModel extends FileUploadModel
{

    public function rules()
    {
        return [
            ['uploadDir', 'required'],
            ['file', 'file', 'extensions' => 'jpg,png,gif,bmp,jpe,jpeg,jpeg']
        ];
    }

}