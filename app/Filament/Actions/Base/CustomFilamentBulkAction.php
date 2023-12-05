<?php

namespace App\Filament\Actions\Base;

use Closure;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class CustomFilamentBulkAction implements CustomFilamentActionInterface
{
    final public static function make(): BulkAction
    {
        return BulkAction::make(static::getActionName())
            ->visible(static::canRun())
            ->steps(static::steps())
            ->action(Closure::fromCallable([static::class, 'handle']));
    }

    /** @param Collection<Model> $records */
    public static abstract function handle(Collection $records, array $data): void;
}
