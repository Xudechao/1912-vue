<?php

namespace App\Exceptions;

use Throwable;

class ApiException extends \RuntimeException
{
    public function __construct(array $apiconst, Throwable $previous = NULL)
    {
        $code = $apiconst[0];
        $message = $apiconst[1];
        parent::__construct($message,$code,$previous);
    }
}
