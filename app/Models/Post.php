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
        'num_comments',
        'num_unique_views',
        'date_of_creation'
    ];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
