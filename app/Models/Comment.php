<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id', 'illustration_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function illustration()
    {
        return $this->belongsTo(Illustration::class);
    }

}
