<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'Post id'=>$this->id,
            'Post title'=>$this->title,
            'Post description'=>$this->description,
            'image'=>$this->image,
            'user_id'=>$this->user_id,
            'Categories'=>$this->Categories->where('status', 1)->map(function($item){
                return [
                    'name' => $item->name,
                    'description' => $item->description,
                ];
            }),
        ];
    }
}
