<?php

namespace App\Services;

use App\Contracts\ClusterServiceInterface;
use App\DTOs\CreateClusterDTO;
use App\Models\Cluster;
use Illuminate\Support\Str;

class ClusterService implements ClusterServiceInterface
{
    public function makeClusterWithCachedURL(CreateClusterDTO $createClusterDTO): Cluster
    {
        /** @var Cluster|null $parentCluster */
        $parentCluster = Cluster::query()->find($createClusterDTO->parent_id);

        $cluster = new Cluster();
        $cluster->parentCluster()->associate($parentCluster);
        $cluster->slug = $createClusterDTO->slug;
        $cluster->breadcrumbs_title = $createClusterDTO->breadcrumbs_title;

        if ($parentCluster === null) {
            $cluster->url = $createClusterDTO->slug;
            return $cluster;
        }

        $urlPrefix = Str::finish($parentCluster->url, '/');
        $cluster->url = str($createClusterDTO->slug)->prepend($urlPrefix)->toString();

        return $cluster;
    }
}
