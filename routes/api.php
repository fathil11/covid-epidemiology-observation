<?php

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

Route::get('/statistic', 'ApiController@statistic');

Route::get('/location/provinces', 'ApiController@provinces');
Route::get('/location/regencies', 'ApiController@allRegencies');
Route::get('/location/{province}/regencies', 'ApiController@regencies');
Route::get('/location/{regency}/districts', 'ApiController@districts');
Route::get('/location/{district}/villages', 'ApiController@villages');

Route::get('/person/nik/is-exists/{nik}', 'ApiController@nikIsExists');
Route::get('/person/id-card/is-exists/{name}', 'ApiController@idCardIsExists');
Route::get('/pe/tube-code/is-exists/{code}', 'ApiController@tubeCodeIsExists');
