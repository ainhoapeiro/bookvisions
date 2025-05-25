<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
    ];

    // Relación con el usuario (dueño de la colección)
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // Relación con ilustraciones
    public function illustrations()
    {
        return $this->belongsToMany(Illustration::class, 'collection_illustration');
    }
}
