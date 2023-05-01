<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'ratingValue' => $this->ratingValue,
            'senderName' => $this->senderName,
            'senderId' => $this->senderId,
            'userId' => $this->userId,
            'postId' => $this->postId,
            'postName' => $this->postName,
            'postCat' => $this->postCat,
            'comment' => $this->comment,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}