<?php

namespace WebStream\Exception\Extend;

use WebStream\Exception\ApplicationException;

/**
 * CsrfException
 * @author Ryuichi TANAKA.
 * @since 2013/10/20
 * @version 0.4
 */
class CsrfException extends ApplicationException
{
    /**
     * constructor
     */
    public function __construct($message = null)
    {
        parent::__construct($message, 400, $this);
    }
}
