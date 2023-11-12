<?php

namespace App\Casts;

use App\Enums\RedirectType;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class RedirectTypeCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): RedirectType
    {
        return RedirectType::from($value);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return $value;
    }
}
