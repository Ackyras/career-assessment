<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface CityInterface
{
    public function get(array $queries);
}
