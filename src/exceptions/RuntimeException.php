<?php

namespace Persec\KSherSdkV2\Exceptions;

use Exception;
use Throwable;

class RuntimeException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
