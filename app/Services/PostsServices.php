<?php

namespace App\Services;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Traits\ApiTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PostsServices
{
    use ApiTrait;

    private $requestType;
    protected $posts;
    protected $post;

    public function __construct($requestType = 'API')
    {
        $this->requestType = $requestType;
    }

    public function getAllPostsApi()
    {
         $this->posts = PostResource::collection(Post::simplePaginate(10));
        if (count($this->posts) == 0)
           return $this->returnError('No Posts');
        return $this->returnData('true' , 'Posts Returned' , $this->posts);

    }

    function getAllPosts() {
        $this->posts = Post::simplePaginate(10);
        return view('posts.index' , ['posts' => $this->posts]);
    }

    public function getPostDetailsApi($post) {
        $this->post = new PostResource($post);
        if (! $this->post['title'])
           return $this->returnError('No Post Found');
       return $this->returnData(
           'Success',
           'Post Returned',
           $this->post);
    }

    public function getPostDetails($post) {
        $this->post = $post;
        return $post;
    }



    public function createPost($request)
    {
        $validate = Validator::make($request->all() , $request->rules());

        if (! $validate->fails()){
            DB::table('posts')->insert([
                'title' => $request['title'],
                'content' => $request['content'],
                'user_id' => $request->user()['id'],
                'created_at' => now()->toDateTimeString()
            ]);
            return $this->checkRequest( $this->returnSuccess('Post Created') ,  toastr()->success('Post Created'));
        }
        return $this->checkRequest($this->returnError($validate->errors()) , toastr()->error('Failed'));

    }

    public function updatePost($request , $post) {
        $this->post = $post;
        if ( $post->author['id'] == $request->user()['id']){
            $post->update([
                'title' => $request['title'],
                'content' => $request['content'],
            ]);
            return $this->returnSuccess('Post Updated ! ');
        }

       return $this->returnError('Not Authorized');
    }

    public function deletePost($request , $post) {

        $this->post = $post;
        if ( $this->requestType !== 'API' || $post->author['id'] == $request->user()['id']){
            $post->delete();
            return $this->checkRequest(
                $this->returnSuccess('Post Deleted') ,
                toastr()->error('Post Deleted!'));
        }

        return $this->returnError('You Are Not Authorized To Delete This Post');


    }



}
