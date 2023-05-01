<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResourceReviewResource extends JsonResource
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
            'resourceId' => $this->resourceId,
            'resourceTitle' => $this->resourceTitle,
            'comment' => $this->comment,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}