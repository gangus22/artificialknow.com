<?php

namespace App\DTOs;

use Spatie\LaravelData\Data;

class InterlinkItemDTO extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $url,
    )
    {
    }
}
