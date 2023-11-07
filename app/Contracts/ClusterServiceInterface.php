<?php

namespace App\Contracts;

use App\DTOs\CreateClusterDTO;
use App\Models\Cluster;

interface ClusterServiceInterface
{
    public function makeClusterWithCachedURL(CreateClusterDTO $createClusterDTO): Cluster;
}
