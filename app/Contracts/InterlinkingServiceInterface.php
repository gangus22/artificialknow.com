<?php

namespace App\Contracts;

use App\Models\Page;
use Illuminate\Support\Collection;

interface InterlinkingServiceInterface
{
    /**
     * @param Page $page
     * @return Collection<int, string>
     */
    public function getUrlsToInterlink(Page $page): Collection;
}
