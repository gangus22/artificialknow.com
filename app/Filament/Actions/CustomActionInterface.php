<?php

namespace App\Filament\Actions;

use Filament\Actions\StaticAction;

interface CustomActionInterface
{
    public static function make(): StaticAction;
}
