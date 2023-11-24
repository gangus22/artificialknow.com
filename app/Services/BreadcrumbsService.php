<?php

namespace App\Services;

use App\Contracts\BreadcrumbsServiceInterface;
use App\DTOs\BreadcrumbItemDTO;
use App\Models\Cluster;
use App\Models\Page;
use Illuminate\Support\Collection;

class BreadcrumbsService implements BreadcrumbsServiceInterface
{
    public function generateBreadcrumbs(Page $page): array
    {
        $breadcrumbs = [];

        $breadcrumbs[] = new BreadcrumbItemDTO('Home', url('/'));

        $page->cluster?->ancestorsAndSelf->reverse()->each(function (Cluster $cluster) use (&$breadcrumbs) {
            $breadcrumbs[] = new BreadcrumbItemDTO($cluster->breadcrumbs_title, url($cluster->pillarPage?->url ?? url('/')));
        });

        if (!$page->isPillarPage()) {
            $breadcrumbs[] = new BreadcrumbItemDTO($page->title_tag, url($page->url));
        }

        return $breadcrumbs;
    }
}
