<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Redirect
 *
 * @property int $id
 * @property string $from
 * @property string $to
 * @property string $type
 */
class Redirect extends Model
{
    use HasFactory;
}
