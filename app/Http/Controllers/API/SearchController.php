<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ProvinceInterface;
use App\Repositories\Interfaces\CityInterface;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private ProvinceInterface $provinceInterface;
    private CityInterface $cityInterface;

    public function __construct(ProvinceInterface $provinceInterface, CityInterface $cityInterface)
    {
        $this->provinceInterface = $provinceInterface;
        $this->cityInterface = $cityInterface;
    }

    public function searchProvince(Request $request)
    {
        return response()->json(
            [
                'query'     =>  $request->query(),
                'result'    =>  $this->provinceInterface->get($request),
            ],
            status: 200,
        );
    }

    public function searchCity(Request $request)
    {
        return response()->json(
            [
                'query'     =>  $request->query(),
                'result'    =>  $this->cityInterface->get($request),
            ],
            status: 200,
        );
    }
}
