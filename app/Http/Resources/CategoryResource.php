<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // You can use this resource to not only return required data, but also to transform that data:
        // Change date format, add prefix or suffix, change case, etc.
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
