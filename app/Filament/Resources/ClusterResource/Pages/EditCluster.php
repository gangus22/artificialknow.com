<?php

namespace App\Filament\Resources\ClusterResource\Pages;

use App\Filament\Resources\ClusterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditCluster extends EditRecord
{
    protected static string $resource = ClusterResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return $record;
    }

    protected function getHeaderActions(): array
    {
        return [
            // TODO: remove deletion of Clusters. Tell users to use redirects instead.
            Actions\DeleteAction::make(),
        ];
    }
}
