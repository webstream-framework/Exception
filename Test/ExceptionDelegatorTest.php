<?php

namespace WebStream\Exception\Test;

require_once dirname(__FILE__) . '/../Modules/DI/Injector.php';
require_once dirname(__FILE__) . '/../Test/Fixtures/InjectedClass.php';
require_once dirname(__FILE__) . '/../Test/Providers/ExceptionDelegatorProvider.php';
require_once dirname(__FILE__) . '/../Delegate/ExceptionDelegator.php';
require_once dirname(__FILE__) . '/../ApplicationException.php';
require_once dirname(__FILE__) . '/../SystemException.php';
require_once dirname(__FILE__) . '/../DelegateException.php';

use WebStream\Exception\DelegateException;
use WebStream\Exception\Delegate\ExceptionDelegator;
use WebStream\Exception\Test\Fixtures\InjectedClass;
use WebStream\Exception\Test\Providers\ExceptionDelegatorProvider;

/**
 * ExceptionDelegatorTest
 * @author Ryuichi TANAKA.
 * @since 2017/01/07
 * @version 0.7
 */
class ExceptionDelegatorTest extends \PHPUnit\Framework\TestCase
{
    use ExceptionDelegatorProvider;

    /**
     * 正常系
     * 例外オブジェクトを保持でき、任意のタイミングでスローできること
     * @test
     * @dataProvider exceptionProvider
     */
    public function okDelegatableExceptionTest($handledException, $exceptionClass)
    {
        $this->expectException(\Exception::class);
        $instance = new InjectedClass();
        $delegator = new ExceptionDelegator($instance, new $exceptionClass("error message"));
        $delegator->raise();
        $this->fail();
    }

    /**
     * 正常系
     * ハンドリング可能な例外がスローされた場合の例外オブジェクト構造が正しいこと
     * さらに例外を指定クラスで捕捉できること
     * @test
     * @dataProvider exceptionProvider
     */
    public function okDelegateAndHandleTest($handledException, $exceptionObject)
    {
        $instance = new InjectedClass();
        $handleList = [
            'exceptions' => [$handledException],
            'refMethod' => new \ReflectionMethod($instance, "handled1")
        ];
        $delegator = new ExceptionDelegator($instance, $exceptionObject);
        $delegator->setExceptionHandler([$handleList]);

        $isAsserted = false;
        try {
            $delegator->raise();
        } catch (\Exception $e) {
            $this->assertInstanceOf(DelegateException::class, $e);
            $this->expectOutputString("handled");
            $isAsserted = true;
        }

        if (!$isAsserted) {
            $this->fail();
        }
    }
}
