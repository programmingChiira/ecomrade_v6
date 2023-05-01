<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MarketReportResource extends JsonResource
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
            'marketImg' => $this->marketImg,
            'senderName' => $this->senderName,
            'senderPhone' => $this->senderPhone,
            'senderId' => $this->senderId,
            'userId' => $this->userId,
            'marketId' => $this->marketId,
            'marketName' => $this->marketName,
            'marketCat' => $this->marketCat,
            'marketSlug' => $this->marketSlug,
            'marketContact' => $this->marketContact,
            'marketPrice' => $this->marketPrice,
            'marketDiscount' => $this->marketDiscount,
            'marketIssue' => $this->marketIssue,
            'marketComplaint' => $this->marketComplaint,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}