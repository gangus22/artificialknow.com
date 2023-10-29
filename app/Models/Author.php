<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    use HasFactory;

    public $timestamps = false;
}
