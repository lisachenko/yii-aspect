<?php

use Go\Instrument\Transformer\FilterInjectorTransformer;


// Load the composer autoloader
include __DIR__ . '/../vendor/autoload.php';

// Load AOP kernel
include __DIR__ . '/aspect.php';

// change the following paths if necessary
$yii=dirname(__FILE__).'/../vendor/yiisoft/yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once(FilterInjectorTransformer::rewrite($yii));
Yii::createWebApplication($config)->run();
