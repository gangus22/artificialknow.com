<?php

namespace App\Models;

use App\Models\Traits\HasCachedUrls;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\Page
 *
 * @property int $id
 * @property int|null $cluster_id
 * @property string $path
 * @property string $title_tag
 * @property string $url
 * @property array $meta
 * @property bool $is_redirected
 * @property bool $visible
 * @property bool $indexed
 * @property bool $is_splash_page
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Cluster|null $cluster
 * @property-read Content|null $content
 */
class Page extends Model
{
    use HasCachedUrls;

    protected $casts = [
        'meta' => 'array',
        'indexed' => 'boolean',
        'visible' => 'boolean',
        'is_redirected' => 'boolean'
    ];

    protected $with = [
        'cluster',
        'content',
    ];

    public function save(array $options = []): bool
    {
        $this->cacheUrl();
        return parent::save($options);
    }

    /**
     * @return BelongsTo<Cluster, Page>
     */
    public function cluster(): BelongsTo
    {
        return $this->belongsTo(Cluster::class);
    }

    /**
     * @return HasOne<Content, Page>
     */
    public function content(): HasOne
    {
        return $this->hasOne(Content::class);
    }

    public function getPrefixParentRelationshipName(): string
    {
        return 'cluster';
    }

    public function _getUrlFallbackAttribute(): string
    {
        return 'path';
    }
}
