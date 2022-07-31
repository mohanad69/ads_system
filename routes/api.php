<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    Auth\LoginController,
    AdController,
    SpaceController,
};

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/login', [LoginController::class, 'login']);

Route::middleware(['auth:sanctum'])->group( function () {
    Route::resource('ads', AdController::class)->except(['create', 'edit', 'update', 'destroy']);
    Route::get('search_ads', [AdController::class, 'searchAds']);
    Route::get('spaces', [SpaceController::class, 'index']);
});
Route::get('detect_device', function()
{
    return detectDevice();
});
