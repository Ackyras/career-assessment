<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//

Route::prefix('v1')->as('v1')->group(function () {
    Route::get('test-connection', function () {
        return response()->json(
            [
                'status' =>  'Connection established',
            ]
        );
    });

    Route::prefix('search')->as('search.')->group(function () {
        Route::get('province', [SearchController::class, 'searchProvince'])->name('province');
        Route::get('city', [SearchController::class, 'searchCity'])->name('city');
    });
});
