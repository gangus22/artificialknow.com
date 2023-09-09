<?php

namespace App\Models;

use App\Exceptions\ClusterDepthException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;
use Staudenmeir\LaravelAdjacencyList\Eloquent\Collection as AdjacencyCollection;

/**
 * App\Models\Cluster
 *
 * @property int $id
 * @property string $slug
 * @property int|null $parent_id
 * @property-read Cluster|null $parentCluster
 * @property-read Collection<int, Page> $pages
 * @property-read AdjacencyCollection|Cluster[] $bloodline
 */
class Cluster extends Model
{
    public $timestamps = false;

    use HasFactory;

    use HasRecursiveRelationships;

    private const MAX_CLUSTER_DEPTH = 2;

    /**
     * @throws ClusterDepthException
     */
    public function save(array $options = []): bool
    {
        if ($this->ancestors()->count() > self::MAX_CLUSTER_DEPTH) {
            throw new ClusterDepthException("Cluster depth for \"$this->slug\" exceeds specified maximum cluster depth (".self::MAX_CLUSTER_DEPTH.')');
        }
        return parent::save($options);
    }

    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }

    public function parentCluster(): BelongsTo
    {
        return $this->belongsTo(Cluster::class, 'parent_id');
    }

    public function isRootCluster(): bool
    {
        return $this->parent_id === null;
    }
}
