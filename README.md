Description
------------

Yii skeleton with some tweaks + [Go AOP PHP](https://github.com/lisachenko/go-aop-php).

This project allows you to test [aspect-oriented programming](http://en.wikipedia.org/wiki/Aspect-oriented_programming) with Yii framework. 

Installation
------------

Installation process is pretty easy, only few steps:
```bash
git clone https://github.com/lisachenko/yii-aspect.git && cd yii-aspect
composer install
```

After that add a `/app` folder as a home directory for web server and just open it in browser.

Aspect definition
-----------------

Aspect class is defined in [TestMonitorAspect](https://github.com/lisachenko/yii-aspect/blob/master/app/protected/extensions/go-aop-php/TestMonitorAspect.php) class:

```php
<?php
namespace Aspect;

use Go\Aop\Aspect;
use Go\Aop\Intercept\FieldAccess;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\After;
use Go\Lang\Annotation\Before;
use Go\Lang\Annotation\Around;
use Go\Lang\Annotation\Pointcut;

/**
 * Monitor aspect
 */
class TestMonitorAspect implements Aspect
{

    /**
     * Method that will be called before real method
     *
     * @param MethodInvocation $invocation Invocation
     * @Before("within(**)")
     */
    public function beforeMethodExecution(MethodInvocation $invocation)
    {
        $obj = $invocation->getThis();
        echo 'Calling Before Interceptor for method: ',
             is_object($obj) ? get_class($obj) : $obj,
             $invocation->getMethod()->isStatic() ? '::' : '->',
             $invocation->getMethod()->getName(),
             '()',
             ' with arguments: ',
             json_encode($invocation->getArguments()),
             "<br>\n";
    }
}
```

How it works? 
-------------

Main feature of AOP is that it doesn't require any changes in the original source code. There is a weaver that modifies logic of original classes and methods according to the rules defined in aspects. So in our example we create an advice (body of the beforeMethodExecution() method) that will receive a MethodInvocation instance as an argument. Next step is to decide where this advice should be applied (it's a pointcut). Here we define "within" pointcut for all public and protected methods (both dynamic and static) with the help of "**" that will match any class. Annotation "@Before" is used to specify, that we want our hook to be called before original method.

Each aspect should be registed in the application [aspect kernel](https://github.com/lisachenko/yii-aspect/blob/master/app/protected/extensions/go-aop-php/ApplicationAspectKernel.php).
