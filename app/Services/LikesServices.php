<?php
namespace App\Services;

use App\Http\Resources\LikeResource;
use App\Models\Post;
use App\Models\UserLikePost;
use App\Traits\ApiTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LikesServices
{
    use ApiTrait;

    public function getPostLikes($post){

        $postId =  $post->id;
        $likes = LikeResource::collection(UserLikePost::query()->where('post_id' , '=' ,  $postId)->get());

        if (count($likes) > 0) {
            return $this->returnData('Success' , 'Post Has Likes' , [
                'numberOfLikes' => count($likes),
                'likesDetails' => $likes
            ]);
        }
        return $this->returnError('No Likes Yet');

    }

    public function isLiked($post , $request) :bool  {
        $like = UserLikePost::query()->where([
            'user_id'  => $request->user()->id ,
            'post_id' => $post->id
            ])->first();

        if (! $like)
            return false;
        return true;
    }

    public function likePostToggle($post , $request){

        if ($this->isLiked($post , $request)){
            DB::table('users_like_posts')->where([
                'user_id' => $request->user()->id ,
                'post_id' => $post->id,
            ])->delete();

        } else {
            DB::table('users_like_posts')->insert([
                'user_id' => $request->user()->id,
                'post_id' => $post->id,
                'created_at' => now()->toDateTimeString()
            ]);

        }
        return $this->returnSuccess('Like Toggled !');


    }

}
