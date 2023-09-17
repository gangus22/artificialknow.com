<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Illuminate\Support\Stringable;

//TODO: store metadata here, in json field
/**
 * App\Models\Page
 *
 * @property int $id
 * @property int|null $cluster_id
 * @property string $path
 * @property bool $indexed
 * @property string $slug
 * @property mixed $meta
 * @property int $visible
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read $url
 * @property-read Cluster|null $cluster
 * @property-read Content|null $content
 */
class Page extends Model
{
    protected $casts = [
        'indexed' => 'boolean'
    ];

    protected $appends = [
        'url'
    ];

    /**
     * @return Attribute<string>
     */
    protected function url(): Attribute
    {
        return Attribute::make(get: function () {
            $bloodlineString = $this->cluster
                ->bloodline
                ->reverse()
                ->reduce(fn (Stringable $carry, Cluster $cluster) => $carry->append($cluster->slug)->append('/'), str(''));

                return $bloodlineString->append($this->path)->toString();
            }
        )->shouldCache();
    }

    // TODO: add uncached URL attribute if needed

    public function cluster(): BelongsTo
    {
        return $this->belongsTo(Cluster::class);
    }

    public function content(): HasOne
    {
        return $this->hasOne(Content::class);
    }
}
