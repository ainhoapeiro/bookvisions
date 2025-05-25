<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'synopsis', 'genre_id', 'image'];

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'genre_id');
    }

    public function illustrations()
    {
        return $this->hasMany(Illustration::class);
    }
}
