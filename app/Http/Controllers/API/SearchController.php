<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use App\Services\CityService;
use App\Services\ProvinceService;
use Illuminate\Http\Request;
use App\Http\Resources\ProvinceResource;

class SearchController extends Controller
{
    //
    public function searchProvince(Request $request, ProvinceService $provinceService)
    {
        $provinces = $provinceService->get($request);
        $query = $request->query();
        if ($provinces) {
            return response()->json(
                [
                    'query'     =>  $query,
                    'result'    =>  $provinces,
                ],
                status: 200,
            );
        }
    }

    public function searchCity(Request $request, CityService $cityService)
    {
        $query = $request->query();
        $cities = $cityService->get($request);
        if ($cities) {
            return response()->json(
                [
                    'query'         =>  $query,
                    'results'       =>  $cities,
                ],
                status: 200,
            );
        }
    }
}
