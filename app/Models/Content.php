<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Content
 *
 * @property int $id
 * @property mixed $article
 * @property int $page_id
 */
class Content extends Model
{
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
