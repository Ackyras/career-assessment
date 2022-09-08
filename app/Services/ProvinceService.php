<?php

namespace App\Services;

use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Resources\ProvinceResource;

class ProvinceService
{
    public function get(Request $request)
    {
        $provinces = Province::query()
            ->when(
                $request->query('id'),
                function ($query) use ($request) {
                    $query->find($request->query('id'));
                },
            )
            ->get();
        // return $provinces;
        if ($provinces->count() > 1) {
            return ProvinceResource::collection($provinces);
        } else {
            return new ProvinceResource($provinces[0]);
        }
    }
}
