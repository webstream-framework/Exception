<?php
namespace WebStream\Exception\Test;

require_once dirname(__FILE__) . '/../Modules/DI/Injector.php';
require_once dirname(__FILE__) . '/../Test/Fixtures/InjectedClass.php';
require_once dirname(__FILE__) . '/../Test/Providers/ExceptionDelegatorProvider.php';
require_once dirname(__FILE__) . '/../Delegate/ExceptionDelegator.php';
require_once dirname(__FILE__) . '/../ApplicationException.php';
require_once dirname(__FILE__) . '/../SystemException.php';


use WebStream\Exception\ApplicationException;
use WebStream\Exception\SystemException;
use WebStream\Exception\Delegate\ExceptionDelegator;
use WebStream\Exception\Test\Fixtures\InjectedClass;
use WebStream\Exception\Test\Providers\ExceptionDelegatorProvider;

/**
* ExceptionDelegatorTest
* @author Ryuichi TANAKA.
* @since 2017/01/07_
* @version 0.7
 */
class ExceptionDelegatorTest extends \PHPUnit_Framework_TestCase
{
    use ExceptionDelegatorProvider;

    /**
     * 正常系
     * 例外オブジェクトを保持でき、任意のタイミングでスローできること
     * @test
     * @dataProvider exceptionProvider
     * @expectedException \Exception
     */
    public function okDelegatableExceptionTest($exception)
    {
        $instance = new InjectedClass();
        $delegator = new ExceptionDelegator($instance, $exception);
        $delegator->raise();
        $this->assertTrue(false);
    }

    /**
     * 正常系
     * 例外オブジェクトのエラーメッセージを取得できること
     * @test
     * @dataProvider exceptionProvider
     */
    public function okDelegatableExceptionTest($exception)
    {
        $instance = new InjectedClass();
        $delegator = new ExceptionDelegator($instance, $exception);
        $delegator->raise();
        $this->assertTrue(false);
    }



    /**
     * 正常系
     * SystemException(RuntimeException)に属する例外は
     * 例外オブジェクトを保持できないこと
     * @dataProvider systemExceptionProvider
     */
    public function okUnDelegatableExceptionTest($exception)
    {
        $instance = new InjectedClass();
        $delegator = new ExceptionDelegator($instance, $exception);
        $delegator->raise();
        $this->assertTrue(false);
    }
}
