<?php

namespace App\Repositories\API;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Services\RajaOngkirService;
use App\Http\Resources\ProvinceResource;
use App\Repositories\Interfaces\ProvinceInterface;

class ProvinceRepository implements ProvinceInterface
{
    public function get(array $queries)
    {
        $client = new Client();
        $rajaOngkirService = new RajaOngkirService($client);
        $provinces = null;
        if ($queries) {
            $provinces = $rajaOngkirService->fetch('province', $queries);
            return $provinces['rajaongkir']['results'];
        } else {
            $provinces = $rajaOngkirService->fetch('province');
            return $provinces;
        }
    }
}
