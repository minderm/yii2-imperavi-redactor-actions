<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace minderm\redactor;

class RedactorModule extends \yii\base\Module {

    public $controllerNamespace = 'minderm\redactor\controllers';
    public $defaultRoute = 'upload';
    public $uploadDir = '@webroot/uploads';
    public $uploadUrl = '';
    public $uploadIdFromSession = 'upload_id';

    public function init()
    {
        parent::init();

        $this->uploadDir = $this->uploadDir.(\Yii::$app->session->get($this->uploadIdFromSession) ? '/'.\Yii::$app->session->get($this->uploadIdFromSession) . '/' : '');
        $this->uploadUrl = $this->uploadUrl.(\Yii::$app->session->get($this->uploadIdFromSession) ? '/'.\Yii::$app->session->get($this->uploadIdFromSession) . '/' : '');
    }
}
