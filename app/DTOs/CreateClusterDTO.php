<?php

namespace App\DTOs;

use Spatie\LaravelData\Data;

class CreateClusterDTO extends Data
{
    public function __construct(
        public readonly ?int   $parent_id,
        public readonly string $slug,
        public readonly string $breadcrumbs_title,
    )
    {
    }
}
