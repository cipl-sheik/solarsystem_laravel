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

Route::get('/user', function (Request $request) {
   return $request->user();
})->middleware('auth:api');
Route::get('solar', function (Request $request) { 
echo "hi";
});

Route::resource('solar-system','API\SolarsystemController');
Route::resource('planets','API\SolarplanetController');

Route::post('/getSun','API\SolarPlanetController@findSun');
Route::post('/getOrbitSun','API\SolarPlanetController@findOrbitSun');
Route::post('/getSolar','API\SolarPlanetController@findSolar');
Route::post('/findSolarPlanet','API\SolarPlanetController@findSolarPlanetByName');
Route::post('/findSolarPlanetSize','API\SolarPlanetController@findSolarPlanetBySize');

