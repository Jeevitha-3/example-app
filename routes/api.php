<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\API\RegisterApiController;
// use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\RegisterController;
use Laravel\Passport\Http\Controllers\AccessTokenController;


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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/register', [RegisterController::class, 'apiStore']);
Route::post('oauth/token', [AccessTokenController::class, 'issueToken']);

Route::middleware('auth:api')->group(function () {
    Route::get('/registers', [RegisterController::class, 'index']);       // GET all
    Route::get('/registers/{id}', [RegisterController::class, 'show']);   // GET one
    Route::put('/registers/{id}', [RegisterController::class, 'apiUpdate']); // UPDATE
    Route::delete('/registers/{id}', [RegisterController::class, 'apiDestroy']); // DELETE
});
