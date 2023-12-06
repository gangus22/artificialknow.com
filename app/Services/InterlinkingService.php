<?php

namespace App\Services;

use App\Contracts\InterlinkingServiceInterface;
use App\DTOs\InterlinkItemDTO;
use App\Models\Page;
use Illuminate\Support\Collection;

class InterlinkingService implements InterlinkingServiceInterface
{

    /**
     * @inheritDoc
     */
    public function getInterlinkItems(Page $page): array
    {
        if (!$page->isPillarPage()) {
            return [];
        }

        $pillarPagesUnderCluster = $page->cluster?->childrenAndSelf->pluck('pages')->flatten()->reject(fn(Page $pageUnderCluster) => !$pageUnderCluster->isPillarPage());

        return $page->cluster->pages->concat($pillarPagesUnderCluster->all())
            ->reject(fn(Page $pageUnderCluster) => $pageUnderCluster->id === $page->id || $pageUnderCluster->content === null)
            ->map(fn(Page $pageUnderCluster) => new InterlinkItemDTO($pageUnderCluster->title_tag, url($pageUnderCluster->url)))
            ->values()
            ->all();
    }
}
