<?php

namespace App\Services;

use App\Contracts\InterlinkingServiceInterface;
use App\Models\Page;
use Illuminate\Support\Collection;

class InterlinkingService implements InterlinkingServiceInterface
{

    /**
     * @inheritDoc
     */
    public function getUrlsToInterlink(Page $page): Collection
    {
        if (!$page->isPillarPage()) {
            return collect();
        }

        return $page->cluster->pages
            ->reject(fn(Page $pageUnderCluster) => $pageUnderCluster->isPillarPage())
            ->map(fn(Page $pageUnderCluster) => $pageUnderCluster->url);
    }
}
