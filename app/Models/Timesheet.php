<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    use HasFactory;

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime'
    ];

    function user() {
        return $this->belongsTo("App\Models\User", 'user_id', 'id');
    }

    function activity() {
        return $this->belongsTo("App\Models\Activity", "activity_id", "id");
    }
}