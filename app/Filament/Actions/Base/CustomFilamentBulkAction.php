<?php

namespace App\Filament\Actions\Base;

use Closure;
use Filament\Actions\StaticAction;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;

abstract class CustomFilamentBulkAction implements CustomFilamentActionInterface
{
    final public static function make(): StaticAction
    {
        return BulkAction::make(static::getActionName())
            ->visible(static::canRun())
            ->steps(static::steps())
            ->action(Closure::fromCallable([static::class, 'handle']));
    }

    public static abstract function handle(Collection $records, array $data): void;
}
