<?php

namespace App\Filament\Actions\Base;

use Closure;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;

abstract class CustomFilamentAction implements CustomFilamentActionInterface
{
    final public static function make(): Action
    {
        return Action::make(static::getActionName())
            ->visible(static::canRun())
            ->steps(static::steps())
            ->action(Closure::fromCallable([static::class, 'handle']));
    }

    protected static abstract function handle(Model $record, array $data): void;
}
