<?php
// app/ApplicationAspectKernel.php

require_once 'TestMonitorAspect.php';

use Aspect\TestMonitorAspect;
use Go\Core\AspectKernel;
use Go\Core\AspectContainer;

/**
 * Application Aspect Kernel
 */
class ApplicationAspectKernel extends AspectKernel
{

    /**
     * Configure an AspectContainer with advisors, aspects and pointcuts
     *
     * @param AspectContainer $container
     *
     * @return void
     */
    protected function configureAop(AspectContainer $container)
    {
        $container->registerAspect(new TestMonitorAspect());
    }
}