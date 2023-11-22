<?php

namespace App\Services;

use App\Contracts\RedirectServiceInterface;
use App\Enums\RedirectType;
use App\Exceptions\AlreadyExistingDestinationException;
use App\Exceptions\RedirectLoopException;
use App\Models\Cluster;
use App\Models\Page;
use App\Models\Redirect;
use Illuminate\Support\Facades\DB;

class RedirectService implements RedirectServiceInterface
{
    public function createRedirect(string $from, string $to, RedirectType $type): void
    {
        $redirect = new Redirect();
        $redirect->from = $from;
        $redirect->to = $to;
        $redirect->type = $type;

        DB::transaction(function () use ($redirect, $type) {
            $redirect = $this->simplifyRedirectChain($redirect);
            $redirect->save();
        });
    }

    public function redirectPage(Page $from, Page $to, RedirectType $type): void
    {
        DB::transaction(function () use ($from, $to, $type) {
            $this->createRedirect($from->url, $to->url, $type);
            $from->is_redirected = true;
            $from->save();

            if ($to->content === null) {
                $to->content()->save($from->content);
                $to->save();
            }
        });
    }

    public function redirectCluster(Cluster $from, Cluster $to, RedirectType $type): void
    {
        $redirectMap = collect();

        $existingDestinationUrls = $to->pages->pluck('url');

        $destinationPages = $from->pages->map(function (Page $page) use ($to, &$redirectMap, $existingDestinationUrls) {
            $destinationPage = $page->replicate()->withoutRelations();

            $destinationPage->cluster()->associate($to);
            $destinationPage->cacheUrl();

            if ($existingDestinationUrls->contains($destinationPage->url)) {
                throw new AlreadyExistingDestinationException($page, $destinationPage);
            }

            $redirectMap->add([$page, $destinationPage]);

            return $destinationPage;
        });

        DB::transaction(function () use ($from, $to, $destinationPages, $redirectMap, $type) {
            $to->pages()->saveMany($destinationPages);

            $redirectMap->each(fn(array $pages) => $this->redirectPage($pages[0], $pages[1], $type));

            $from->children->each(function (Cluster $childCluster) use ($to, $type) {
                $destinationCluster = $childCluster->replicate();

                $destinationCluster->parentCluster()->associate($to);
                $destinationCluster->save();

                $this->redirectCluster($childCluster, $destinationCluster, $type);
            });

            $from->is_redirected = true;
            $from->save();
        });
    }

    /**
     * @param Redirect $redirect
     * @return Redirect
     * @throws RedirectLoopException
     */
    private function simplifyRedirectChain(Redirect $redirect): Redirect
    {
        $chain = collect([$redirect]);

        /** @var Redirect|null $nextRedirect */
        $nextRedirect = Redirect::query()->firstWhere('from', '=', $redirect->to);

        while ($nextRedirect !== null) {
            if ($chain->contains($nextRedirect)) {
                throw new RedirectLoopException($chain);
            }

            $chain->add($nextRedirect);

            $nextRedirect = Redirect::query()->firstWhere('from', '=', $nextRedirect->to);
        }

        /** @var Redirect|null $previousRedirect */
        $previousRedirect = Redirect::query()->firstWhere('to', '=', $redirect->from);

        while ($previousRedirect !== null) {
            if ($chain->contains($previousRedirect)) {
                throw new RedirectLoopException($chain);
            }

            $chain->prepend($previousRedirect);

            $previousRedirect = Redirect::query()->firstWhere('to', '=', $previousRedirect->from);
        }

        $redirect->from = $chain->first()->from;
        $redirect->to = $chain->last()->to;

        $chain->each(fn(Redirect $redirect) => $redirect->delete());

        return $redirect;
    }
}
