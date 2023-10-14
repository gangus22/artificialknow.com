<?php

namespace App\Models;

use App\Casts\AsMetaDataDTO;
use App\DTOs\MetaDataDTO;
use App\Enums\MetaDataEnum;
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
 * @property MetaDataDTO $meta
 * @property bool $visible
 * @property bool $indexed
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Attribute<string> $url
 * @property-read Cluster|null $cluster
 * @property-read Content|null $content
 */
class Page extends Model
{
    protected $casts = [
        'meta' => AsMetaDataDTO::class,
        'indexed' => 'boolean',
        'visible' => 'boolean',
    ];

    protected $attributes = [
        'meta' => MetaDataEnum::DEFAULT_JSON_VALUE,
    ];

    protected $with = [
        'cluster',
        'content',
    ];

    protected $appends = [
        'url',
    ];

    /**
     * @return Attribute<string>
     */
    protected function url(): Attribute
    {
        return Attribute::make(get: fn () => str($this->cluster->url)->append($this->path)->toString())
            ->shouldCache();
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
}
