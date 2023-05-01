<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClubChatRoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

     public function toArray($request)
     {
         $user_id = auth()->id();
         $in_room = $this->roomUsers->where('user_id', $user_id)->count() > 0;
         return [
             'id' => $this->id,
             'user_id' => $this->user_id,
             'club_id' => $this->club_id,
             'name' => $this->name,
             'slug' => $this->slug,
             'in_room' => $in_room,
         ];
     }
}