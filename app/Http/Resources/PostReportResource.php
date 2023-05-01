<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostReportResource extends JsonResource
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
            'postImg' => $this->postImg,
            'senderName' => $this->senderName,
            'senderPhone' => $this->senderPhone,
            'senderId' => $this->senderId,
            'userId' => $this->userId,
            'postId' => $this->postId,
            'postName' => $this->postName,
            'postCat' => $this->postCat,
            'postSlug' => $this->postSlug,
            'postIssue' => $this->postIssue,
            'postComplaint' => $this->postComplaint,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}