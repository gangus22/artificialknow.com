<?php

namespace App\Services;

use App\Contracts\BreadcrumbsServiceInterface;
use App\DTOs\BreadcrumbsItemDTO;
use App\Models\Cluster;
use App\Models\Page;
use Illuminate\Support\Collection;

class BreadcrumbsService implements BreadcrumbsServiceInterface
{
    public function generateBreadcrumbs(Page $page): array
    {
        $breadcrumbs = [];

        $breadcrumbs[] = new BreadcrumbsItemDTO('Home', url('/'));

        $page->cluster?->ancestorsAndSelf->reverse()->each(function (Cluster $cluster) use (&$breadcrumbs) {
            $breadcrumbs[] = new BreadcrumbsItemDTO($cluster->breadcrumbs_title, url($cluster->pillarPage?->url ?? url('/')));
        });

        if (!$page->isPillarPage()) {
            $breadcrumbs[] = new BreadcrumbsItemDTO($page->title_tag, url($page->url));
        }

        return $breadcrumbs;
    }
}
