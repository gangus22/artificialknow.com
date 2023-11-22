<?php

namespace App\Models;

use App\Casts\RedirectTypeCast;
use App\Enums\RedirectType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Redirect
 *
 * @property int $id
 * @property string $from
 * @property string $to
 * @property RedirectType $type
 */
class Redirect extends Model
{
    public $timestamps = false;

    protected $casts = [
        'type' => RedirectTypeCast::class,
    ];
}
