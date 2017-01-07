<?php
namespace WebStream\Exception\Test\Providers;

use WebStream\Exception\ApplicationException;
use WebStream\Exception\SystemException;

/**
 * ExceptionDelegatorProvider
 * @author Ryuichi TANAKA.
 * @since 2017/01/08
 * @version 0.7
 */
trait ExceptionDelegatorProvider
{
    public function exceptionProvider()
    {
        return [
            [new SystemException("SystemException")],
            [new ApplicationException("ApplicationException")]
        ];
    }

    public function applicationExceptionProvider()
    {
        return [
            [new ApplicationException("ApplicationExcecption")]
        ];
    }
}
