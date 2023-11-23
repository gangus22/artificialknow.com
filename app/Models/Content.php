<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Content
 *
 * @property int $id
 * @property string $name
 * @property mixed $article
 * @property int $page_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Page $page
 * @property-read Author $author
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

    /**
     * @return BelongsTo<Author, Content>
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}
