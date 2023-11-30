<?php

namespace App\Filament\Actions\Base;

use Filament\Actions\StaticAction;
use Filament\Forms\Components\Wizard\Step;

interface CustomFilamentActionInterface
{
    public static function make(): StaticAction;

    static function getActionName(): string;

    /** @return array<Step> */
    static function steps(): array;
}
