<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface ProvinceInterface
{
    public function get(array $queries);
}
