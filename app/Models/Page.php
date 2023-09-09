<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

//TODO: store metadata here, in json field
/**
 * App\Models\Page
 *
 * @property int $id
 * @property int|null $cluster_id
 * @property string $path
 * @property bool $indexed
 * @property string $slug
 * @property-read Cluster|null $cluster
 * @property-read Content|null $content
 */
class Page extends Model
{
    use HasFactory;

    protected $casts = [
        'indexed' => 'boolean'
    ];

    /**
     * @return Attribute<string>
     */
    protected function url(): Attribute
    {
        return Attribute::make(get: function () {
                return $this->cluster
                    ->bloodline
                    ->flip()
                    ->reduce(fn (Cluster $cluster, string $carry) => str($carry)->append('/')->append($cluster->slug), '');
            }
        )->shouldCache();
    }

    public function cluster(): BelongsTo
    {
        return $this->belongsTo(Cluster::class);
    }

    public function content(): HasOne
    {
        return $this->hasOne(Content::class);
    }
}
