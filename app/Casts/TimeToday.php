<?php

namespace App\Casts;

use Illuminate\Support\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class TimeToday implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        return Carbon::today()->setTime(...explode(':', $value));
    }

    public function set($model, $key, $value, $attributes)
    {
        if ($value instanceof Carbon) {
            return Carbon::now()->getTimestamp();
        }

        return $value;
    }
}
