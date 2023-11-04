<?php

namespace App\Services;

use App\Contracts\BreadcrumbsServiceInterface;
use App\Models\Cluster;
use App\Models\Page;
use Illuminate\Support\Collection;

class BreadcrumbsService implements BreadcrumbsServiceInterface
{
    public function generateBreadcrumbs(Page $page): array
    {
        $breadcrumbs = collect();

        $breadcrumbs->put('Home', url('/'));

        $page->cluster?->ancestorsAndSelf->reverse()->each(function (Cluster $cluster) use ($breadcrumbs) {
            $breadcrumbs->put(
                $cluster->breadcrumbs_title ?? str($cluster->slug)->title()->toString(),
                url($cluster->pillarPage?->url ?? url('/'))
            );
        });

        $breadcrumbs->put($page->title_tag, url($page->url));

        return $breadcrumbs->all();
    }
}
