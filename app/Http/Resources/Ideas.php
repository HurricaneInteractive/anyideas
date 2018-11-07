<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;

class Ideas extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'success' => $this->success,
            'category' => $this->category,
            'title' => $this->title,
            'pitch' => $this->pitch,
            'status' => $this->status,
            'tags' => $this->tags,
            'description' => $this->description,
            'darts' => $this->darts,
            'image' => $this->image,
            'user_data' => UserResource::make($this->user)
        ];
    }
}
