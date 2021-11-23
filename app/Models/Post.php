<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'image',
        'num_likes',
        'num_unique_views',
        'date_of_creation'
    ];

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

