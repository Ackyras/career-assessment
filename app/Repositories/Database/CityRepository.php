<?php

namespace App\Repositories\Database;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Resources\CityResource;
use App\Repositories\Interfaces\CityInterface;

class CityRepository implements CityInterface
{
    public function get(array $queries)
    {
        $cities = City::query()
            ->when(
                isset($queries['id']),
                function ($query) use ($queries) {
                    $query->find($queries['id']);
                },
            )
            ->when(
                isset($queries['province']),
                function ($query) use ($queries) {
                    $query->where('province_id', $queries['province']);
                },
            )
            ->with('province')
            ->get();
        if ($cities) {
            if ($cities->count() == 1) {
                return new CityResource($cities[0]);
            } else {
                return CityResource::collection($cities);
            }
        }
    }
}
