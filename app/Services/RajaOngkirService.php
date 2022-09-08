<?php

namespace App\Services;

use App\Models\City;
use GuzzleHttp\Client;
use App\Models\Province;
use GuzzleHttp\Exception\RequestException;

class RajaOngkirService
{
    protected $url;
    protected $client;
    protected $api_key;
    protected $headers;

    public function __call($method, $arguments)
    {
        if ($method == 'fetch') {
            if (count($arguments) == 1) {
                return call_user_func_array(array($this, 'fetchAll'), $arguments);
            } else if (count($arguments) == 2) {
                return call_user_func_array(array($this, 'fetchOne'), $arguments);
            }
        }
    }

    public function __construct(Client $client)
    {
        $this->url = 'https://api.rajaongkir.com/starter/';
        $this->client = $client;
        $this->api_key = env('RAJA_ONGKIR_API_KEY');
        $this->headers = [
            'key'   =>  $this->api_key,
        ];
    }

    public function fetchAll(string $type): array
    {
        $request = $this->client->get(
            $this->url . $type,
            [
                'headers'   =>  $this->headers,
            ]
        );

        $response = $request ? $request->getBody()->getContents() : null;
        $status = $request ? $request->getStatusCode() : 500;

        if ($response && $status === 200 && $response !== 'null') {
            $json = json_decode($response, true);
            $dataArray = [];
            foreach ($json['rajaongkir']['results'] as $data) {
                array_push(
                    $dataArray,
                    $data
                );
            }
            return $dataArray;
        }
        return null;
    }

    public function fetchOne(string $type, array $queries): array
    {
        $url = $this->url . $type . '?';
        foreach ($queries as $key => $value) {
            $url = $url . $key . '=' . $value . '&';
        }
        $request = $this->client->get(
            $url,
            [
                'headers'   =>  $this->headers,
            ]
        );

        $response = $request ? $request->getBody()->getContents() : null;
        $status = $request ? $request->getStatusCode() : 500;

        if ($response && $status === 200 && $response !== 'null') {
            $json = json_decode($response, true);
            $dataArray = $json;
            return $dataArray;
        }
        return null;
    }

    public function storeByType(array $datas, $type)
    {
        if ($type == 'city') {
            foreach ($datas as $key => $data) {
                City::updateOrCreate(
                    [
                        'id'    =>  $data['city_id'],
                    ],
                    [
                        'id'                =>  $data['city_id'],
                        'name'              =>  $data['city_name'],
                        'type'              =>  $data['type'],
                        'postal_code'       =>  $data['postal_code'],
                        'province_id'       =>  $data['province_id'],
                    ]
                );
            }
        } else {
            foreach ($datas as $data) {
                Province::updateOrCreate(
                    [
                        'id'    =>  $data['province_id']
                    ],
                    [
                        'id'                =>  $data['province_id'],
                        'name'              =>  $data['province'],
                    ]
                );
            }
        }
    }

    public function isDataExists()
    {
        $provincesCount = Province::count();
        $citiesCount = City::count();
        if ($provincesCount > 0 || $citiesCount > 0) {
            return true;
        }
        return false;
    }
}
