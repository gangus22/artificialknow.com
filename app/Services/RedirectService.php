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

        DB::transaction(function () use ($redirect, $type) {
            $redirect = $this->simplifyRedirectChain($redirect);
            $redirect->type = $type;

            $redirect->save();
        });
    }

    public function redirectCluster(Cluster $from, Cluster $to, RedirectType $type): void
    {
        $redirectMap = collect();

        $from->load('pages');
        $existingDestinationUrls = $to->pages->pluck('url');

        $destinationPages = $from->pages->map(function (Page $page) use ($to, &$redirectMap, $existingDestinationUrls) {
            $destinationPage = $page->replicate();

            $destinationPage->cluster()->associate($to);
            $destinationPage->cacheUrl();

            if ($existingDestinationUrls->contains($destinationPage->url)) {
                throw new AlreadyExistingDestinationException($page, $destinationPage);
            }

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

    /**
     * @param Redirect $redirect
     * @param array<Redirect> $chain
     * @return Redirect
     * @throws RedirectLoopException
     */
    private function simplifyRedirectChain(Redirect $redirect, array &$chain = []): Redirect
    {
        $chain[] = $redirect;

        /** @var Redirect|null $nextRedirect */
        $nextRedirect = Redirect::query()->firstWhere('from', '=', $redirect->to);

        if ($nextRedirect === null) {
            $redirect->from = $chain[0]->from;

            collect($chain)->each(fn(Redirect $redirect) => $redirect->delete());

            return $redirect;
        }

        if (in_array($nextRedirect, $chain)) {
            throw new RedirectLoopException($chain);
        }

        return $this->simplifyRedirectChain($nextRedirect, $chain);
    }
}
