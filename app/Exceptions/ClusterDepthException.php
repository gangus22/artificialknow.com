<?php

namespace App\Exceptions;

use Exception;

class ClusterDepthException extends Exception
{
    protected $message = 'Cluster depth exceeds specified maximum';
}
