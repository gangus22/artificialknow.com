<?php

namespace App\Services;

use App\Contracts\PageServiceInterface;
use App\Models\Cluster;
use App\Models\Page;
use Illuminate\Support\Str;

class PageService implements PageServiceInterface
{
    public function makePageWithCachedURL(array $attributes): Page
    {
        $page = new Page();
        $page->fill($attributes);

        /** @var Cluster|null $cluster */
        $cluster = Cluster::query()->find($page->cluster_id);

        if ($cluster === null) {
            $page->url = $page->path;
            return $page;
        }

        $urlPrefix = Str::finish($cluster->url, '/');
        $page->url = str($page->path)->prepend($urlPrefix)->toString();

        return $page;
    }
}
