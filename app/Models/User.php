<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'roles' => 'array'
    ];

    public function isAdmin() {
        return in_array("admin", $this->roles);
    }

    public function isManager() {
        return in_array("manager", $this->roles) && !in_array("admin", $this->roles);
    }

    public function isUser() {
        return in_array("[]", $this->roles) || in_array("user", $this->roles);
    }
}
