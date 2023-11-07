<?php

namespace App\Services;

use App\Contracts\ClusterServiceInterface;
use App\Models\Cluster;
use Illuminate\Support\Str;

class ClusterService implements ClusterServiceInterface
{
    public function makeClusterWithCachedURL(array $attributes): Cluster
    {
        $cluster = new Cluster();
        $cluster->fill($attributes);

        /** @var Cluster|null $parentCluster */
        $parentCluster = Cluster::query()->find($cluster->parent_id);

        if ($parentCluster === null) {
            $cluster->url = $cluster->slug;
            return $cluster;
        }

        $urlPrefix = Str::finish($parentCluster->url, '/');
        $cluster->url = str($cluster->slug)->prepend($urlPrefix)->toString();

        return $cluster;
    }
}
