<?php

namespace App\Contracts;

use App\Models\Cluster;

interface ClusterServiceInterface
{
    public function makeClusterWithCachedURL(array $attributes): Cluster;
}
