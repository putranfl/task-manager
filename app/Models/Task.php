<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Sesuaikan dengan definisi kolom dalam tabel "tasks"
    protected $fillable = ['name', 'description', 'status', 'user_id', 'image']; 

    // Definisikan relasi many-to-one (inverse of one-to-many) dengan tabel "users"
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

