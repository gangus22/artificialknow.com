<?php

namespace App\Contracts;

use Filament\Forms\Components\Builder;

interface ContentServiceInterface
{
    public function getFilamentContentBuilder(string $name): Builder;
}
