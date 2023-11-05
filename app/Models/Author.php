<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Author
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $bio
 * @property string|null $img_path
 * @property string|null $linkedin
 */
class Author extends Model
{
    public $timestamps = false;

    /**
     * @return HasMany<Content, Author>
     */
    public function contents(): HasMany
    {
        return $this->hasMany(Content::class);
    }
}
