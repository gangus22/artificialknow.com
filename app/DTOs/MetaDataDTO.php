<?php

namespace App\DTOs;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class MetaDataDTO extends Data
{
    //TODO: default values for ogs
    public function __construct(
        public readonly string  $metaDescription,
        #[MapInputName('og:title')]
        public readonly string  $ogTitle,
        #[MapInputName('og:description')]
        public readonly string  $ogDescription,
        #[MapInputName('og:image')]
        public readonly ?string $ogImage = '',
    )
    {
    }
}
