<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class ApiErrHandler extends Exception
{
    public function __construct(array $apiconst, Throwable $previous = NULL)
    {
        $error_no = $apiconst[0];
        $error_msg = $apiconst[1];
        parent::__construct($error_msg,$error_no,$previous);

    }
}
