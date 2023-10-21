<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Content
 *
 * @property int $id
 * @property string $name
 * @property mixed $article
 * @property int $page_id
 *
 * @property-read Page $page
 */
class Content extends Model
{
    protected $casts = [
        'article' => 'array'
    ];

    /**
     * @return BelongsTo<Page, Content>
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
