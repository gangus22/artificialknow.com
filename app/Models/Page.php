<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Page
 *
 * @property int $id
 * @property int $cluster_id
 * @property string $slug
 * @property int $indexed
 */
class Page extends Model
{
    use HasFactory;
}
