<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;


    public function post() {
        return $this->belongsTo(Post::class)->without(['likes' , 'author']);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }


}
