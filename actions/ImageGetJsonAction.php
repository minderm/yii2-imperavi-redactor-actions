<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace minderm\redactor\actions;

use Yii;
use yii\web\HttpException;
use yii\helpers\FileHelper;
use yii\helpers\Json;

class ImageGetJsonAction extends \yii\base\Action {

    private $_sourcePath;
    public $sourcePath = false;
    public $baseUrl = false;

    public function init()
    {
        if (!Yii::$app->request->isAjax) {
            throw new HttpException(403, 'This action allow only ajaxRequest');
        }

        $this->_sourcePath = $this->sourcePath ? $this->sourcePath : $this->controller->module->uploadDir;
        $this->baseUrl = $this->baseUrl ? $this->baseUrl : ($this->controller->module->uploadUrl ? $this->controller->module->uploadUrl : $this->baseUrl);
    }

    public function run()
    {
        $files = FileHelper::findFiles($this->getPath(), ['recursive' => true, 'only' => ['*.jpg', '*.jpeg', '*.jpe', '*.png', '*.gif']]);
        if ($this->sourcePath || $this->baseUrl)
        {
            if (is_array($files) && count($files)) {
                $result = [];
                $path = $this->getPath();
                foreach ($files as $file) {
                    $url = str_replace($path, $this->baseUrl, $file);
                    $result[] = ['thumb' => $url, 'image' => $url];
                }
                echo Json::encode($result);
            }
        }
        elseif (is_array($files) && count($files)) {
            $result = [];
            foreach ($files as $file) {
                $url = $this->getUrl($file);
                $result[] = ['thumb' => $url, 'image' => $url];
            }
            echo Json::encode($result);
        }
    }

    protected function getPath()
    {
        if ($this->sourcePath)
            return Yii::getAlias($this->sourcePath);
        else
            return Yii::getAlias($this->_sourcePath);
    }

    public function getUrl($path)
    {
        return str_replace(DIRECTORY_SEPARATOR, '/', str_replace(Yii::getAlias('@webroot'), '', $path));
    }

}
