<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLikePost extends Model
{
    use HasFactory;

    protected $table = 'users_like_posts';

    public function post() {
        return $this->belongsTo(Post::class , 'post_id');
    }
    public function user() {
        return $this->belongsTo(User::class , 'user_id');
    }
}
