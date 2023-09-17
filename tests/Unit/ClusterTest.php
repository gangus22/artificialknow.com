<?php

use App\Exceptions\ClusterDepthException;
use App\Models\Cluster;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('New Cluster with zero depth is saved into DB', function () {
    $cluster = Cluster::factory()->create();

    $this->assertDatabaseHas('clusters', $cluster->toArray());
});

test('New Cluster with acceptable depth is saved into DB', function () {
    $cluster = Cluster::factory()->create();
    $cluster2 = Cluster::factory()->create();
    $cluster3 = Cluster::factory()->create();

    $cluster2->parentCluster()->associate($cluster);
    $cluster2->save();
    $cluster3->parentCluster()->associate($cluster2);
    $cluster3->save();

    $this->assertDatabaseHas('clusters', $cluster->toArray());
    $this->assertDatabaseHas('clusters', $cluster2->withoutRelations()->toArray());
    $this->assertDatabaseHas('clusters', $cluster3->withoutRelations()->toArray());
    expect($cluster2->parentCluster)->toBe($cluster)
        ->and($cluster3->parentCluster)->toBe($cluster2);
});

test('Attempting to save Cluster with too much depth throws exception', function () {
    $cluster = Cluster::factory()->create();
    $cluster2 = Cluster::factory()->create();
    $cluster3 = Cluster::factory()->create();
    $cluster4 = Cluster::factory()->create();

    $cluster2->parentCluster()->associate($cluster);
    $cluster2->save();
    $cluster3->parentCluster()->associate($cluster2);
    $cluster3->save();

    $this->expectException(ClusterDepthException::class);
    $cluster4->parentCluster()->associate($cluster3);
    $cluster4->save();
});

