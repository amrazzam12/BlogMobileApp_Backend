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
use Illuminate\Validation\Rule;

class CommentsServices{

    use ApiTrait;

   public function getPostComments($id) {
        $comments = CommentResource::collection(Comment::where('post_id' , $id)->get());
        if (count($comments) == 0)
           return $this->returnError();

        return $this->returnData('Success' , 'Comments Returned' , $comments);
    }


    public function getUserComments($id) {
        $comments = CommentResource::collection(Comment::where('user_id' , $id)->get());
        if (count($comments) == 0)
            return $this->returnError();

        return $this->returnData('Success' , 'Comments Returned' , $comments);
    }

    public function makeComment($post , $request){
       $data = $request->all();
       $validate = Validator::make($data , [
           'comment' => 'required|max:400',
           'user_id' => [ Rule::exists('users' , 'id')]
       ]);

       if (! $validate->fails()){
           DB::table('comments')->insert([
               'comment' => $data['comment'],
               'post_id' => $post->id,
               'user_id' => $request->user()->id,
               'created_at' => now()
           ]);

           return $this->returnSuccess('Comment Created On Post ' . $post->id);

       }else{
           return $this->returnError($validate->errors());
       }
    }

}
