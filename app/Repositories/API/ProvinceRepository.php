<?php

namespace App\Repositories\API;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Services\RajaOngkirService;
use App\Http\Resources\ProvinceResource;
use App\Repositories\Interfaces\ProvinceInterface;

class ProvinceRepository implements ProvinceInterface
{
    public function get(Request $request)
    {
        $client = new Client();
        $rajaOngkirService = new RajaOngkirService($client);
        $provinces = null;
        $query = $request->query();
        if ($request->query()) {
            $provinces = $rajaOngkirService->fetch('province', $query);
            return $provinces['rajaongkir']['results'];
        } else {
            $provinces = $rajaOngkirService->fetch('province');
            return $provinces;
        }
    }
}
