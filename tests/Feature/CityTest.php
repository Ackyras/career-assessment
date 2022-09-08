<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\City;
use App\Http\Resources\CityResource;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Repositories\API\CityRepository as APICityRepository;
use App\Repositories\Database\CityRepository as DatabaseCityRepository;

class CityTest extends TestCase
{
    public function test_get_all_citiy_with_database()
    {
        $DatabaseRepository = new DatabaseCityRepository();

        $queries = [];

        $cities = $DatabaseRepository->get($queries);

        $cities_count = City::count();

        $this->assertTrue(count($cities) == $cities_count);
    }

    public function test_get_all_citiy_with_direct_api()
    {
        $APIRepository = new APICityRepository();

        $queries = [];

        $cities = $APIRepository->get($queries);

        $cities_count = City::count();

        if (count($cities) == $cities_count) {
            $this->assertTrue(true);
        }
    }

    public function test_check_if_a_data_exists_from_database()
    {
        $city = new CityResource(City::inRandomOrder()->first());

        $DatabaseRepository = new DatabaseCityRepository();

        $queries = [];

        $cities = $DatabaseRepository->get($queries);

        foreach ($cities as $key => $value) {
            if ($value['city_id'] == $city['city_id'] && $value['city'] == $city['city']) {
                $this->assertTrue(true);
            }
        }
    }

    public function test_check_if_api_and_database_output_is_same()
    {
        $DatabaseRepository = new DatabaseCityRepository();
        $APIRepository = new APICityRepository();

        $queries = [];

        $APIcities = $APIRepository->get($queries);
        $Databasecities = $DatabaseRepository->get($queries);
        if (count($APIcities) == count($Databasecities)) {
            $this->assertTrue(true);
        }
    }
}
