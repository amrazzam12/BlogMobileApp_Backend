<?php

namespace App\Services;


use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\Comment;
use App\Models\Post;
use App\Traits\ApiTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CommentsServices{

    use ApiTrait;

    function getPostComments($id) {
        $comments = CommentResource::collection(Comment::where('post_id' , $id)->get());
        if (count($comments) == 0)
           return $this->returnError();

        return $this->returnData('Success' , 'Comments Returned' , $comments);
    }


    function getUserComments($id) {
        $comments = CommentResource::collection(Comment::where('user_id' , $id)->get());
        if (count($comments) == 0)
            return $this->returnError();

        return $this->returnData('Success' , 'Comments Returned' , $comments);
    }

}
