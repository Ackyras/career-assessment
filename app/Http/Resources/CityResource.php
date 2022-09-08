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
            'province_id'       =>  $this->province->id,
            'province'          =>  $this->province->name,
            'type'              =>  $this->type,
            'city_name'         =>  $this->name,
            'postal_code'       =>  $this->postal_code,
        ];
    }
}
