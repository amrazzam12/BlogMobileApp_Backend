<?php

namespace App\Http\Resources;

use App\Models\Comment;
use App\Models\UserLikePost;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'author' => $this->author->name,
            'countOfLikes' => count($this->likes),
            'likesDetails' => LikeResource::collection($this->likes),
            'comments' => CommentResource::collection($this->comments)
        ];
    }
}
