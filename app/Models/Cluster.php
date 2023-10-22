<?php

namespace App\Models;

use App\Exceptions\ClusterDepthException;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Stringable;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;
use Staudenmeir\LaravelAdjacencyList\Eloquent\Collection as AdjacencyCollection;

/**
 * App\Models\Cluster
 *
 * @property int $id
 * @property string $slug
 * @property int|null $parent_id
 * @property-read Attribute<string> $url
 * @property-read Cluster|null $parentCluster
 * @property-read Collection<int, Page> $pages
 * @property-read AdjacencyCollection|Cluster[] $ancestors
 */
class Cluster extends Model
{
    use HasFactory;

    use HasRecursiveRelationships;

    public $timestamps = false;

    protected $with = [
        'ancestors'
    ];

    private const MAX_CLUSTER_DEPTH = 2;

    /**
     * @return Attribute<string>
     */
    protected function url(): Attribute
    {
        return Attribute::make(get: fn() => $this->ancestors
            ->reverse()
            ->reduce(fn(Stringable $carry, Cluster $cluster) => $carry->append($cluster->slug)->append('/'), str(''))
            ->append($this->slug, '/')
            ->toString()
        )
            ->shouldCache();
    }

    /**
     * @throws ClusterDepthException
     */
    public function save(array $options = []): bool
    {
        if ($this->ancestors()->count() > self::MAX_CLUSTER_DEPTH) {
            throw new ClusterDepthException();
        }
        return parent::save($options);
    }

    /**
     * @return HasMany<Page, Cluster>
     */
    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }

    /**
     * @return BelongsTo<Cluster, Cluster>
     */
    public function parentCluster(): BelongsTo
    {
        return $this->belongsTo(Cluster::class, 'parent_id');
    }

    public function isRootCluster(): bool
    {
        return $this->parent_id === null;
    }
}
