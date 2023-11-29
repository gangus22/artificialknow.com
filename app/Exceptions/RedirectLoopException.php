<?php

namespace App\Exceptions;

use App\Models\Redirect;
use Throwable;

class RedirectLoopException extends \Exception
{
    public function __construct(Redirect $redirect, int $code = 0, ?Throwable $previous = null)
    {
        $message = "Creation of a new redirect from $redirect->from to $redirect->to from would cause a redirect loop.";
        parent::__construct($message, $code, $previous);
    }
}
