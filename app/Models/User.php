<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasFactory;

    protected $fillable = ['name', 'email', 'password'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}

