<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PollVoteResource extends JsonResource
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
            'senderName' => $this->senderName,
            'senderId' => $this->senderId,
            'userId' => $this->userId,
            'pollId' => $this->pollId,
            'pollVote' => $this->pollVote,
            'vote' => $this->vote,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}