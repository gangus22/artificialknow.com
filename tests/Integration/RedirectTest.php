<?php

use App\Contracts\RedirectServiceInterface;
use App\Enums\RedirectType;
use App\Models\Cluster;
use App\Models\Page;
use App\Models\Redirect;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

$redirectTypes = [RedirectType::Permanent, RedirectType::Temporary];

test('Simple Cluster redirect without depth', function (RedirectType $type) {
    $cluster = Cluster::factory()->create();
    $cluster2 = Cluster::factory()->create();

    $clusterPages = Page::factory()->count(3)->create();
    $cluster->pages()->saveMany($clusterPages);

    /** @var RedirectServiceInterface $redirectService */
    $redirectService = app()->make(RedirectServiceInterface::class);
    $redirectService->redirectCluster($cluster, $cluster2, $type);
    $cluster2->refresh();

    $this->assertTrue($cluster->is_redirected);
    $this->assertEqualsCanonicalizing($cluster2->pages->pluck('path'), $clusterPages->pluck('path'));
    $this->assertEquals(Redirect::query()->count(), 3);
})->with($redirectTypes);

test('Cluster redirect with depth', function (RedirectType $type) {
    $cluster = Cluster::factory()->create();
    $cluster2 = Cluster::factory()->create();

    $childCluster = Cluster::factory()->create();
    $childCluster->parentCluster()->associate($cluster);
    $childCluster->save();

    $childCluster2 = Cluster::factory()->create();
    $childCluster2->parentCluster()->associate($cluster);
    $childCluster2->save();

    $clusterPages = Page::factory()->count(3)->create();
    $cluster->pages()->saveMany($clusterPages);

    $childClusterPages = Page::factory()->count(3)->create();
    $childCluster->pages()->saveMany($childClusterPages);

    $childClusterPages2 = Page::factory()->count(3)->create();
    $childCluster2->pages()->saveMany($childClusterPages2);

    /** @var RedirectServiceInterface $redirectService */
    $redirectService = app()->make(RedirectServiceInterface::class);
    $redirectService->redirectCluster($cluster, $cluster2, $type);
    $cluster2->refresh();


    $originalChildPages = collect([...$clusterPages, ...$childClusterPages, ...$childClusterPages2]);
    $childPagesUnderCluster2 = $cluster2->childrenAndSelf->pluck('pages')->flatten();

    $this->assertTrue($cluster->is_redirected);
    $this->assertTrue($childPagesUnderCluster2->every(fn(Page $page) => str($page->url)->endsWith($originalChildPages->pluck('path'))));
    $this->assertEquals(Redirect::query()->count(), 9);
})->with($redirectTypes);


