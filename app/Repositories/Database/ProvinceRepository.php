<?php

namespace App\Repositories\Database;

use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Resources\ProvinceResource;
use App\Repositories\Interfaces\ProvinceInterface;

class ProvinceRepository implements ProvinceInterface
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
