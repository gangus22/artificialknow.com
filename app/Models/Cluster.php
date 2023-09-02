<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Cluster
 *
 * @property int $id
 * @property string $slug
 * @property int|null $parent_id
 */
class Cluster extends Model
{
    use HasFactory;
}
