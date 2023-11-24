<?php

namespace App\Models;

use App\Models\Traits\HasCachedUrls;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

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
class Page extends Model implements Sitemapable
{
    use HasFactory;
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

    public function isPillarPage(): bool
    {
        return $this->id === $this->cluster->pillarPage?->id;
    }

    public function getPrefixParentRelationshipName(): string
    {
        return 'cluster';
    }

    public function getUrlFallback(): string
    {
        return 'path';
    }

    public function toSitemapTag(): Url|string|array
    {
        return Url::create(url($this->url))
            ->setLastModificationDate($this->content->updated_at ?? $this->updated_at)
            ->setChangeFrequency('monthly');
    }
}
