<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace minderm\redactor\models;

use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use yii\helpers\Inflector;
use yii\helpers\Json;

class FileUploadModel extends \yii\base\Model {

    public $file;
    public $uploadDir;
    public $baseUrl;
    private $_filename;

    public function rules()
    {
        return [
            ['uploadDir', 'required'],
            ['file', 'file']
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            return $this->file->saveAs($this->getPath(), true);
        }

        return false;
    }

    public function toJson()
    {
        return Json::encode(['filelink' => $this->getUrl(), 'filename' => $this->normalizeFilename()]);
    }

    public function getPath()
    {
        $path = Yii::getAlias($this->uploadDir);
        FileHelper::createDirectory($path);
        return $path . DIRECTORY_SEPARATOR . $this->normalizeFilename();
    }

    public function getUrl()
    {
        return $this->baseUrl ? str_replace(Yii::getAlias($this->uploadDir), $this->baseUrl, $this->getPath()) : str_replace(DIRECTORY_SEPARATOR, '/', str_replace(Yii::getAlias('@webroot'), '', $this->getPath()));
    }

    protected function getExtensionName()
    {
        if (strstr($this->file, '.')) {
            return preg_replace('/^.*?\./', '.', strtolower($this->file));
        }
        return '';
    }

    protected function normalizeFilename()
    {
        if (!$this->_filename) {
            $extensionName = $this->getExtensionName();
            if (!empty($extensionName)) {
                $name = Inflector::slug(preg_replace('/\..*?$/', '', strtolower($this->file)));
                $name .= $extensionName;
            } else {
                $name = strtolower($this->file);
            }
            $this->_filename = substr(uniqid(md5(rand()), true), 0, 10) . '.' . $name;
        }
        return $this->_filename;
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->file = UploadedFile::getInstanceByName('file');
            return true;
        }
        return false;
    }

}
