<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('trigger', 'TriggerController@storePeopleData');
Route::get('trigger2', 'TriggerController@storeTestData');
// Route::get('trigger3', 'TriggerController@storeSecondTestData');
// Route::get('trigger4', 'TriggerController@storeThirthTestData');
Route::get('trigger5', 'TriggerController@updateTestAt');
Route::get('trigger6', 'TriggerController@updateAllEntitiesCase');
Route::get('trigger7', 'TriggerController@updatePersonWork');

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
    // Route::get('pe', 'AdminController@showPe')->name('admin.pe.index');
    Route::get('hasil', 'AdminController@showAllResults')->name('admin.result.all');
    Route::get('pe', 'AdminController@showAllPe')->name('admin.pe.all');
    Route::get('pe/{code}/hasil/positif', 'AdminController@positiveTestResult')->name('admin.pe.result.positive');
    Route::get('pe/{code}/hasil/negatif', 'AdminController@negativeTestResult')->name('admin.pe.result.negative');
    Route::get('pe/{code}/hasil/hapus', 'AdminController@deleteTestResult')->name('admin.pe.result.delete');
});

Route::group(['middleware' => 'lab', 'prefix' => 'lab'], function () {
    Route::get('pe', 'LabController@showPe')->name('lab.pe');
    Route::get('pe/all', 'LabController@showAllPe')->name('lab.pe.all');
    Route::get('pe/{code}/aksi/positif', 'LabController@positive')->name('lab.pe.action.positive');
    Route::get('pe/{code}/aksi/negatif', 'LabController@negative')->name('lab.pe.action.negative');
    Route::get('pe/{code}/aksi/tarik', 'LabController@retire')->name('lab.pe.action.retire');
});

Route::group(['middleware' => 'pe'], function () {
    Route::get('pasien', 'RegistrationController@showPeopleSearch')->name('registration.pe.people-search');
    Route::get('pasien/buat', 'RegistrationController@showCreatePerson')->name('registration.person.create');
    Route::post('pasien/buat', 'RegistrationController@storePerson')->name('registration.person.store');
    Route::get('pasien/edit/{id}', 'RegistrationController@showEditPerson')->name('registration.person.edit');
    Route::post('pasien/edit/{id}', 'RegistrationController@updatePerson')->name('registration.person.update');

    Route::get('pe', 'PeController@index')->name('pe.index');
    Route::get('pe/{code}', 'PeController@show')->name('pe.view');
    Route::get('pe/{code}/download', 'PeController@download')->name('pe.download');
    Route::get('pe/lanjutan/check/{id}', 'RegistrationController@checkCreatePe')->name('registration.pe.create.check');
    Route::get('pe/buat/{id}', 'RegistrationController@showCreatePe')->name('registration.pe.create');
    Route::post('pe/buat/{id}', 'RegistrationController@storePe')->name('registration.pe.store');

});

Route::group(['middleware' => 'statistic', 'prefix' => 'statistik'], function () {
    Route::get('/', 'StatisticController@index')->name('statistic');
    Route::get('positif', 'StatisticController@showPositivePeople')->name('statistic.positive');
    Route::get('negatif', 'StatisticController@showNegativePeople')->name('statistic.negative');
});

Route::get('hasil/{code}', 'PublicController@showResult')->name('public.result');
Route::get('hasil/{code}/download-surat', 'PublicController@downloadResult')->name('public.result.mail.download');

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
