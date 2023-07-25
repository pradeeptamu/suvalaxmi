<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $table = 'password_resets';

    protected $fillable = [
        'token',
        'email',
        'created_at'
    ];

    public $timestamps = false;
}
