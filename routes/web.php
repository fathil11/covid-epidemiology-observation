<?php

use App\Province;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['prefix' => 'pendaftaran', 'middleware' => 'auth'], function () {
    Route::get('orang-baru', 'RegistrationController@showCreatePerson')->name('registration.person.create');
    Route::post('orang-baru', 'RegistrationController@storePerson')->name('registration.person.store');

    Route::get('pe-lanjutan', 'RegistrationController@showNikCheck')->name('registration.pe.nik-check');
    Route::post('pe-lanjutan', 'RegistrationController@redirectNikToCreatePe')->name('registration.pe.redirect-nik');
    Route::get('pe-lanjutan/{nik}', 'RegistrationController@showCreatePe')->name('registration.pe.create');
    Route::post('pe-lanjutan/{nik}', 'RegistrationController@storePe')->name('registration.pe.store');
});

Route::get('hasil/{code}', 'PublicController@showResult');

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
