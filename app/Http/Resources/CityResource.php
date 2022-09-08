<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            'city_id'           =>  $this->id,
            'name'              =>  $this->name,
            'type'              =>  $this->type,
            'postal_code'       =>  $this->postal_code,
            'province'          =>  new ProvinceResource($this->province)
        ];
    }
}