<?php

namespace App\Services;

use App\Http\Resources\CityCollection;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Http\Request;

class CityService
{
    public function get(Request $request)
    {
        $cities = City::query()
            ->when(
                $request->query('id'),
                function ($query) use ($request) {
                    $query->find($request->query('id'));
                },
            )
            ->when(
                $request->query('province'),
                function ($query) use ($request) {
                    $query->where('province_id', $request->query('province'));
                },
            )
            ->with('province')
            ->get();
        if ($cities->count() > 1) {
            return CityResource::collection($cities);
        } else {
            return new CityResource($cities[0]);
        }
    }
}
