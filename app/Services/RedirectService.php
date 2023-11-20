<?php

namespace App\Services;

use App\Contracts\RedirectServiceInterface;
use App\Enums\RedirectType;
use App\Models\Cluster;
use App\Models\Page;
use App\Models\Redirect;
use Illuminate\Support\Facades\DB;

class RedirectService implements RedirectServiceInterface
{

    public function createRedirect(string $from, string $to, RedirectType $type): void
    {
        // TODO: check loops etc
        $redirect = new Redirect();
        $redirect->from = $from;
        $redirect->to = $to;
        $redirect->type = $type;

        $redirect->save();
    }

    public function redirectCluster(Cluster $from, Cluster $to, RedirectType $type): void
    {
        $redirectMap = collect();

        $from->load('pages');

        $destinationPages = $from->pages->map(function (Page $page) use ($to, &$redirectMap) {
            $destinationPage = $page->replicate();

            $destinationPage->cluster()->associate($to);
            $destinationPage->cacheUrl();
            // TODO: check if these pages exist on destination already
            $redirectMap->put($page->url, $destinationPage->url);

            return $destinationPage;
        });

        DB::transaction(function () use ($from, $to, $destinationPages, $redirectMap, $type) {
            $to->pages()->saveMany($destinationPages);

            $redirectMap->each(fn(string $urlTo, string $urlFrom) => $this->createRedirect($urlFrom, $urlTo, $type));

            $from->children->each(function (Cluster $childCluster) use ($to, $type) {
                $destinationCluster = $childCluster->replicate();

                $destinationCluster->parentCluster()->associate($to);
                $destinationCluster->save();

                $this->redirectCluster($childCluster, $destinationCluster, $type);
            });
        });
    }
}
