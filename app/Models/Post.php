<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

        protected $guarded = [];

    public function author() {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function likes() {
        return $this->hasMany(UserLikePost::class , 'post_id')->with('user:id,name');
    }

    public function comments() {
        return $this->hasMany(Comment::class , 'post_id')->with('user:id,name');
    }

}
