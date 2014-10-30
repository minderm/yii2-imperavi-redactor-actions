<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace minderm\redactor\widgets;

use Yii;
use yii\helpers\Url;
use yii\widgets\InputWidget;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\web\AssetBundle;
use yii\helpers\ArrayHelper;

class Redactor extends \yii\imperavi\Widget
{

    public $options = [
        'imageManagerJson' => '/redactor/upload/imagejson',
        'imageUpload' => '/redactor/upload/image',
        'fileUpload' => '/redactor/upload/file',
        'buttonSource' => true,
    ];

    public $plugins = ['table', 'video', 'fullscreen', 'imagemanager', 'filemanager'];

    public function init()
    {

        $this->options['imageManagerJson'] = Url::toRoute(['/redactor/upload/imagejson']);
        $this->options['imageUpload'] = Url::toRoute(['/redactor/upload/image']);
        $this->options['fileUpload'] = Url::toRoute(['/redactor/upload/file']);

        parent::init();
    }
}
