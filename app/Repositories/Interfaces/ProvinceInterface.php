<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface ProvinceInterface
{
    public function get(Request $request);
}
