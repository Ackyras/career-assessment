<?php

namespace App\Repositories\API;

use Illuminate\Http\Request;
use App\Services\RajaOngkirService;
use App\Repositories\Interfaces\CityInterface;
use GuzzleHttp\Client;

class CityRepository implements CityInterface
{
    public function get(Request $request)
    {
        $client = new Client();
        $rajaOngkirService = new RajaOngkirService($client);
        $query = $request->query();
        if ($request->query()) {
            $cities = $rajaOngkirService->fetch('city', $query);
            return $cities['rajaongkir']['results'];
        } else {
            $cities = $rajaOngkirService->fetch('city');
            return $cities;
        }
    }
}
