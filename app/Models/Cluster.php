<?php

namespace App\Models;

use App\Exceptions\ClusterDepthException;
use App\Models\Traits\HasCachedUrls;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;
use Staudenmeir\LaravelAdjacencyList\Eloquent\Collection as AdjacencyCollection;

/**
 * App\Models\Cluster
 *
 * @property int $id
 * @property string $slug
 * @property string $breadcrumbs_title
 * @property int|null $parent_id
 * @property string $url
 * @property bool $is_redirected
 * @property-read Cluster|null $parentCluster
 * @property-read Collection<int, Page> $pages
 * @property-read Page|null $pillarPage,
 * @property-read AdjacencyCollection|Cluster[] $children
 * @property-read AdjacencyCollection|Cluster[] $ancestors
 * @property-read AdjacencyCollection|Cluster[] $ancestorsAndSelf
 */
class Cluster extends Model
{
    use HasFactory;

    use HasRecursiveRelationships;

    use HasCachedUrls;

    public $timestamps = false;

    protected $casts = [
        'is_redirected' => 'boolean'
    ];

    private const MAX_CLUSTER_DEPTH = 2;

    /**
     * @throws ClusterDepthException
     */
    public function save(array $options = []): bool
    {
        if ($this->ancestors()->count() > self::MAX_CLUSTER_DEPTH) {
            throw new ClusterDepthException();
        }
        $this->cacheUrl();
        return parent::save($options);
    }

    /**
     * @return HasMany<Page, Cluster>
     */
    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }

    public function pillarPage(): HasOne
    {
        return $this->hasOne(Page::class)->whereNull('path');
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
