<?php

namespace App\Filament\Resources\ClusterResource\Pages;

use App\Contracts\ClusterServiceInterface;
use App\DTOs\CreateClusterDTO;
use App\Filament\Resources\ClusterResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;

class CreateCluster extends CreateRecord
{
    protected static string $resource = ClusterResource::class;

    /**
     * @throws BindingResolutionException
     */
    protected function handleRecordCreation(array $data): Model
    {
        /** @var ClusterServiceInterface $clusterService */
        $clusterService = app()->make(ClusterServiceInterface::class);

        $cluster = $clusterService->makeClusterWithCachedURL($data);

        return parent::handleRecordCreation($cluster->attributesToArray());

    }
}
