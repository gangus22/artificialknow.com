<?php

namespace App\Contracts;

use App\Models\Page;

interface PageServiceInterface
{
    public function makePageWithCachedURL(array $attributes): Page;
}
