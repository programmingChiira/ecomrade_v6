<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RentalBookingResource extends JsonResource
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
            'rentalImg' => $this->rentalImg,
            'senderName' => $this->senderName,
            'senderPhone' => $this->senderPhone,
            'senderId' => $this->senderId,
            'userId' => $this->userId,
            'rentalId' => $this->rentalId,
            'rentalName' => $this->rentalName,
            'rentalSlug' => $this->rentalSlug,
            'rentalCategory' => $this->rentalCategory,
            'rentalPrice' => $this->rentalPrice,
            'rentalInfo' => $this->rentalInfo,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}