<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function comments()
    {
        return $this->hasMany('App\Models\Comments', 'on_post');
    }

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }
}
