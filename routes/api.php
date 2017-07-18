<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->post('/countdown', 'CountdownController@store');
Route::middleware('auth:api')->put('/countdown', 'CountdownController@update');
Route::middleware('auth:api')->get('/countdown/{id}', 'CountdownController@show');
Route::middleware('auth:api')->get('/countdowns', 'CountdownController@index');

Route::middleware('auth:api')->post('/images', 'ImagesController@store');
Route::middleware('auth:api')->delete('/images/{id}', 'ImagesController@destroy');
Route::middleware('auth:api')->get('/countdown/{countdown_id}/images', 'ImagesController@show');

Route::middleware('api')->get('/test', function () {
    return \Illuminate\Http\JsonResponse::create(['name' => ['first' => 'Doug', 'last' => 'Steinberg']]);
});
