<?php
namespace WebStream\Test;

require_once dirname(__FILE__) . '/../vendor/autoload.php';
require_once dirname(__FILE__) . '/../Modules/DI/Injector.php';
require_once dirname(__FILE__) . '/../Delegate/ExceptionDelegator.php';
require_once dirname(__FILE__) . '/Hoge.php';

use WebStream\Exception\Delegate\ExceptionDelegator;

$instance = new Hoge();
$exception = new \Exception();
$delegator = new ExceptionDelegator($instance, $exception);

var_dump($delegator);
$delegator->raise();
