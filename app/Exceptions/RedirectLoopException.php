<?php

namespace App\Exceptions;

use Illuminate\Contracts\Support\Arrayable;
use Throwable;

class RedirectLoopException extends \Exception
{
    public function __construct(Arrayable $chain, int $code = 0, ?Throwable $previous = null)
    {
        $message = "Creation of a new redirect would cause a redirect loop. Chain parsed: " . collect($chain)->implode(' -> ');
        parent::__construct($message, $code, $previous);
    }
}
