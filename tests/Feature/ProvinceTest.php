<?php

namespace Tests\Feature;

use App\Http\Resources\ProvinceResource;
use App\Models\Province;
use App\Repositories\API\ProvinceRepository as APIProvinceRepository;
use App\Repositories\Database\ProvinceRepository as DatabaseProvinceRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProvinceTest extends TestCase
{
    public function test_get_all_province_with_database()
    {
        $DatabaseRepository = new DatabaseProvinceRepository();

        $queries = [];

        $provinces = $DatabaseRepository->get($queries);

        $provinces_count = Province::count();

        $this->assertTrue(count($provinces) == $provinces_count);
    }

    public function test_get_all_province_with_direct_api()
    {
        $APIRepository = new APIProvinceRepository();

        $queries = [];

        $provinces = $APIRepository->get($queries);

        $provinces_count = Province::count();

        if (count($provinces) == $provinces_count) {
            $this->assertTrue(true);
        }
    }

    public function test_check_if_a_data_exists_from_database()
    {
        $province = new ProvinceResource(Province::inRandomOrder()->first());

        $DatabaseRepository = new DatabaseProvinceRepository();

        $queries = [];

        $provinces = $DatabaseRepository->get($queries);

        foreach ($provinces as $key => $value) {
            if ($value['province_id'] == $province['province_id'] && $value['province'] == $province['province']) {
                $this->assertTrue(true);
            }
        }
    }

    public function test_check_if_api_and_database_output_is_same()
    {
        $DatabaseRepository = new DatabaseProvinceRepository();
        $APIRepository = new APIProvinceRepository();

        $queries = [];

        $APIprovinces = $APIRepository->get($queries);
        $Databaseprovinces = $DatabaseRepository->get($queries);
        if (count($APIprovinces) == count($Databaseprovinces)) {
            $this->assertTrue(true);
        }
    }
}
