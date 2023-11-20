<?php

namespace App\Exceptions;

use App\Models\Page;
use Exception;
use Throwable;

class AlreadyExistingDestinationException extends Exception
{
    public function __construct(Page $from, Page $to, int $code = 0, ?Throwable $previous = null)
    {
        $message = "Cluster based redirect from $from->url to $to->url would overwrite an already existing page";
        parent::__construct($message, $code, $previous);
    }
}
