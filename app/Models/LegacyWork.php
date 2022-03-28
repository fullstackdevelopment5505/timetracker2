<?php

namespace App\Models;

use App\Casts\TimeToday;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegacyWork extends Model
{
    protected $table = "legacy_work";

    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'account_start_time' => TimeToday::class,
    ];

    public $timestamps = false;
}
