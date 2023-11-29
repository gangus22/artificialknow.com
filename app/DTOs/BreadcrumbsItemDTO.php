<?php

namespace App\DTOs;

use Spatie\LaravelData\Data;

class BreadcrumbsItemDTO extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $url,
    )
    {
    }
}
