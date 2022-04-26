<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LikeResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'user' => $this->user->name,
            'post' => $this->post->id,
            'liked_at' => $this->created_at->diffForHumans()
        ];
    }
}
