<?php

namespace App\Http\Resources;

use App\Models\Post;
use App\Models\UserLikePost;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'Joined' => $this->created_at->diffForHumans(),
            'posts' => PostResource::collection($this->posts),
            'comments' => CommentResource::collection($this->comments)


        ];
    }
}
