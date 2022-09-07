<?php

namespace App\Console\Commands\FetchApi;

use App\Models\City;
use GuzzleHttp\Client;
use App\Models\Province;
use App\Services\RajaOngkirService;
use Illuminate\Console\Command;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\Console\Helper\ProgressBar;

class RajaOngkir extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:raja-ongkir';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetching data from Raja Ongkir API and save it to DB.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(RajaOngkirService $rajaOngkirService)
    {
        $isDataExists = $rajaOngkirService->isDataExists();
        if ($isDataExists) {
            $this->info('Province and City data already exists in database. This action will renew the record');
            if (!$this->confirm('Continue?')) {
                exit();
            }
        }
        try {
            $this->info('Fetching Provinces...');
            $provinces = $rajaOngkirService->fetch('province');
            $this->info('Fetching Provinces completed');
            $this->info('Fetching City...');
            $cities = $rajaOngkirService->fetch('city');
            $this->info('Fetching Cities completed');
            $this->info('Number of Provinces : ' . count($provinces));
            $this->info('Number of Cities : ' . count($cities));
        } catch (\Exception $e) {
            //throw $th;
            return response()->json(
                [
                    'error' => $e->getMessage()
                ]
            );
        }
        if ($provinces) {
            $this->info('Storing Provinces data...');
            $rajaOngkirService->storeByType($provinces, 'province');
            $this->info('Storing Provinces data completed');
        }
        if ($cities) {
            $this->info('Storing Cities data...');
            $rajaOngkirService->storeByType($cities, 'city');
            $this->info('Storing Cities data completed');
        }
    }
}
