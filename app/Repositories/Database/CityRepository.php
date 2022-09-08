<?php

namespace App\Repositories\Database;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Resources\CityResource;
use App\Repositories\Interfaces\CityInterface;

class CityRepository implements CityInterface
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
        if ($cities) {
            if ($cities->count() == 1) {
                return new CityResource($cities[0]);
            } else {
                return CityResource::collection($cities);
            }
        }
    }
}
