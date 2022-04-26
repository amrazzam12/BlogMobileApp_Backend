<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PostRequest;
use App\Models\Post;
use App\Services\LikesServices;
use App\Services\PostsServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(): JsonResponse
    {
        return (new PostsServices)->getAllPostsApi();
    }

    public function show(Post $post): JsonResponse
    {
        return (new PostsServices)->getPostDetailsApi($post);
    }

    public function store(PostRequest $request) {
        return (new PostsServices)->createPost($request);
    }

    public function update(PostRequest $request , Post $post): JsonResponse
    {
        return (new PostsServices)->updatePost($request , $post);
    }

    public function destroy(PostRequest $request , Post $post) {
        return (new PostsServices)->deletePost($request , $post);
    }

    public function getLikes(Post $post)
    {
        return (new LikesServices)->getPostLikes($post);
    }

    public function toggleLike(Post $post , Request $request): JsonResponse
    {
        return (new LikesServices)->likePostToggle($post, $request);
    }
}
