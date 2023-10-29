<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use App\Models\Cluster;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        /** @var Cluster|null $cluster */
        $cluster = Cluster::query()->find(data_get($data, 'cluster_id'));

        if ($cluster === null) {
            $data['url'] = $data['path'];
            return parent::handleRecordCreation($data);
        }

        $urlPrefix = Str::finish($cluster->url, '/');
        $data['url'] = str($data['slug'])->prepend($urlPrefix)->toString();

        return parent::handleRecordCreation($data);
    }
}
