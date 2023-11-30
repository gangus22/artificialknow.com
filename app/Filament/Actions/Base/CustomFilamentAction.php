<?php

namespace App\Filament\Actions\Base;

use Closure;
use Filament\Actions\StaticAction;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;

abstract class CustomFilamentAction implements CustomFilamentActionInterface
{
    final public static function make(): StaticAction
    {
        return Action::make(static::getActionName())
            ->steps(static::steps())
            ->action(Closure::fromCallable([static::class, 'handle']));
    }

    protected static abstract function handle(Model $record, array $data): void;
}
