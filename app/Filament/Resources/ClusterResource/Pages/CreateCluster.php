<?php

namespace App\Filament\Resources\ClusterResource\Pages;

use App\Filament\Resources\ClusterResource;
use App\Models\Cluster;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CreateCluster extends CreateRecord
{
    protected static string $resource = ClusterResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        /** @var Cluster|null $parentCluster */
        $parentCluster = Cluster::query()->find(data_get($data, 'parent_id'));

        if ($parentCluster === null) {
            $data['url'] = $data['slug'];
            return parent::handleRecordCreation($data);
        }

        $urlPrefix = Str::finish($parentCluster->url, '/');
        $data['url'] = str($data['slug'])->prepend($urlPrefix)->toString();

        return parent::handleRecordCreation($data);
    }
}
