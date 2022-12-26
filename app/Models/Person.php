<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'isFavorite',
        'user_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
