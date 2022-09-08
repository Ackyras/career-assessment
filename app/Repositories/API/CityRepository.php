<?php

namespace App\Repositories\API;

use Illuminate\Http\Request;
use App\Services\RajaOngkirService;
use App\Repositories\Interfaces\CityInterface;
use GuzzleHttp\Client;

class CityRepository implements CityInterface
{
    public function get(array $queries)
    {
        $client = new Client();
        $rajaOngkirService = new RajaOngkirService($client);
        if ($queries) {
            $cities = $rajaOngkirService->fetch('city', $queries);
            return $cities['rajaongkir']['results'];
        } else {
            $cities = $rajaOngkirService->fetch('city');
            return $cities;
        }
    }
}
