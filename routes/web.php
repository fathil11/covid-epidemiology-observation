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

Route::group(['middleware' => 'admin'], function () {
    Route::get('trigger-count-check', 'TriggerController@triggerCountCheck');
    Route::get('trigger-published-at', 'TriggerController@triggerResultPublishedAt');
    Route::get('trigger-status-log', 'TriggerController@triggerTestStatusLog');
});

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
    Route::get('hasil', 'AdminController@showAllResults')->name('admin.result.all');

    Route::get('pe', 'AdminController@showAllPe')->name('admin.pe.all');
    Route::get('pe/buat', 'AdminController@createPe')->name('admin.pe.create');
    Route::post('pe/buat', 'AdminController@storePe')->name('admin.pe.store');
    Route::get('pe/{code}/edit', 'AdminController@editPe')->name('admin.pe.edit');
    Route::post('pe/{code}/update', 'AdminController@updatePe')->name('admin.pe.update');
    Route::delete('pe/{code}/hapus', 'AdminController@deletePe')->name('admin.pe.delete');

    Route::get('pe/{code}/hasil/positif', 'AdminController@positiveTestResult')->name('admin.pe.result.positive');
    Route::get('pe/{code}/hasil/negatif', 'AdminController@negativeTestResult')->name('admin.pe.result.negative');
    Route::delete('pe/{code}/hasil/hapus', 'AdminController@deleteTestResult')->name('admin.pe.result.delete');
    Route::get('statistik', 'StatisticController@index')->name('admin.statistics');
    Route::get('konfirmasi/status', 'StatusController@index')->name('admin.status.index');
    Route::get('konfirmasi/status/{code}/isolasi', 'StatusController@isolate')->name('admin.status.isolate');
    Route::get('konfirmasi/status/{code}/sembuh', 'StatusController@recover')->name('admin.status.recover');
    Route::get('konfirmasi/status/{code}/meninggal', 'StatusController@die')->name('admin.status.die');
    Route::get('publikasi', 'DataPublicationController@index')->name('admin.publication');
    Route::get('publikasi/data', 'DataPublicationController@publish')->name('admin.publication.publish');
});

Route::group(['middleware' => 'lab', 'prefix' => 'lab'], function () {
    Route::get('pe', 'LabController@showPe')->name('lab.pe');
    Route::get('pe/all', 'LabController@showAllPe')->name('lab.pe.all');
    Route::get('pe/{code}/aksi/positif', 'LabController@positive')->name('lab.pe.action.positive');
    Route::get('pe/{code}/aksi/negatif', 'LabController@negative')->name('lab.pe.action.negative');
    Route::get('pe/{code}/aksi/tarik', 'LabController@retire')->name('lab.pe.action.retire');
});

Route::group(['middleware' => 'registration'], function () {
    Route::get('pasien', 'RegistrationController@showPeopleSearch')->name('registration.pe.people-search');
    Route::get('pasien/buat', 'RegistrationController@showCreatePerson')->name('registration.person.create');
    Route::post('pasien/buat', 'RegistrationController@storePerson')->name('registration.person.store');
    Route::get('pasien/edit/{id}', 'RegistrationController@showEditPerson')->name('registration.person.edit');
    Route::post('pasien/edit/{id}', 'RegistrationController@updatePerson')->name('registration.person.update');

    Route::get('pe', 'PeController@index')->name('pe.index');

    Route::get('pe/absen', 'PeController@showPresence')->name('pe.presence.show');
    Route::post('pe/{code}/absen', 'PeController@presence')->name('pe.presence');
    Route::get('pe/{code}/absen/hapus', 'PeController@deletePresence')->name('pe.presence.delete');

    Route::get('pe/{code}', 'PeController@show')->name('pe.view');
    Route::get('pe/{code}/download', 'PeController@download')->name('pe.download');
    Route::get('pe/lanjutan/check/{id}', 'RegistrationController@checkCreatePe')->name('registration.pe.create.check');
    Route::get('pe/buat/{id}', 'RegistrationController@showCreatePe')->name('registration.pe.create');
    Route::post('pe/buat/{id}', 'RegistrationController@storePe')->name('registration.pe.store');

});

Route::group(['middleware' => 'isSecondPe'], function(){
    Route::get('/daftar/hasil', 'ResultController@index');
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
