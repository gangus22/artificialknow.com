<?php

use App\Contracts\RedirectServiceInterface;
use App\Enums\RedirectType;
use App\Exceptions\AlreadyExistingDestinationException;
use App\Exceptions\RedirectLoopException;
use App\Models\Cluster;
use App\Models\Page;
use App\Models\Redirect;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

$redirectTypes = [RedirectType::Permanent, RedirectType::Temporary];

test('Create redirect while simplifying chain', function (RedirectType $type) {
    /** @var RedirectServiceInterface $redirectService */
    $redirectService = app()->make(RedirectServiceInterface::class);

    $redirectService->createRedirect('one', 'two', $type);
    $redirectService->createRedirect('two', 'three', $type);

    $this->assertDatabaseHas('redirects', ['from' => 'one', 'to' => 'three', 'type' => $type->value]);
})->with($redirectTypes);

test('Create redirect and detect loop', function (RedirectType $type) {
    /** @var RedirectServiceInterface $redirectService */
    $redirectService = app()->make(RedirectServiceInterface::class);

    $this->expectException(RedirectLoopException::class);

    $redirectService->createRedirect('one', 'two', $type);
    $redirectService->createRedirect('two', 'one', $type);
})->with($redirectTypes);

test('Simple Cluster redirect', function (RedirectType $type) {
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

test('Deep Cluster redirect', function (RedirectType $type) {
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

test('Deep Cluster redirect with conflicting urls', function (RedirectType $type) {
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

    /** @var Page $conflictingPage */
    $conflictingPage = $clusterPages->first()->replicate();
    $conflictingPage->cluster()->associate($cluster2);
    $conflictingPage->save();

    $childClusterPages = Page::factory()->count(3)->create();
    $childCluster->pages()->saveMany($childClusterPages);

    $childClusterPages2 = Page::factory()->count(3)->create();
    $childCluster2->pages()->saveMany($childClusterPages2);

    $this->expectException(AlreadyExistingDestinationException::class);

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


