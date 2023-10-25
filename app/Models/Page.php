<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
 * @property string $name
 * @property string $slug
 * @property string $url
 * @property array $meta
 * @property bool $visible
 * @property bool $indexed
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Cluster|null $cluster
 * @property-read Content|null $content
 */
class Page extends Model
{
    protected $casts = [
        'meta' => 'array',
        'indexed' => 'boolean',
        'visible' => 'boolean',
    ];

    protected $with = [
        'cluster',
        'content',
    ];

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
}
