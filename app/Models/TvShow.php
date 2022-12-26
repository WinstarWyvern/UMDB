<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TvShow extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'show_id',
        'score',
        'review',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
