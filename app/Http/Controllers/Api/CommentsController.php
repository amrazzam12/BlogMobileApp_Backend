<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\User;
use App\Services\CommentsServices;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function postComments($id) {
        return  (new CommentsServices)->getPostComments($id);
    }

    public function userComments($id) {
        return  (new CommentsServices)->getUserComments($id);
    }
}
