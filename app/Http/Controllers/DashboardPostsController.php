<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostsServices;
use Illuminate\Http\Request;

class DashboardPostsController extends Controller
{
    //

    public function index() {
        return (new PostsServices)->getAllPosts();
    }

    public function show(Post $post) {
        return (new PostsServices)->getPostDetails($post);
    }

    public function destroy(Request $request , Post $post){
         (new PostsServices('normalRequest'))->deletePost($request , $post);
         return back();
    }
}
