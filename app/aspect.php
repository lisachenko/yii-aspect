<?php

include __DIR__ . '/protected/extensions/go-aop-php/ApplicationAspectKernel.php';

// Prevent an error about nesting level
ini_set('xdebug.max_nesting_level', 500);

// Initialize an application aspect container
$applicationAspectKernel = ApplicationAspectKernel::getInstance();
$applicationAspectKernel->init(array(
    'debug' => true,
    // Application root directory
    'appDir'   => __DIR__ . '/../',
    // Cache directory
    'cacheDir' => __DIR__ . './protected/aspect',
    'excludePaths' => array(
        __DIR__ . './protected/aspect'
    )
));
