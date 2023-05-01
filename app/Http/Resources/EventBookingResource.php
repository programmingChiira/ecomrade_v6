<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventBookingResource extends JsonResource
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
            'eventImg' => $this->eventImg,
            'senderName' => $this->senderName,
            'senderPhone' => $this->senderPhone,
            'senderId' => $this->senderId,
            'userId' => $this->userId,
            'eventId' => $this->eventId,
            'eventTitle' => $this->eventTitle,
            'eventSlug' => $this->eventSlug,
            'eventDescription' => $this->eventDescription,
            'eventDate' => $this->eventDate,
            'eventTime' => $this->eventTime,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}