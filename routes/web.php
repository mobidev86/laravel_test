<?php

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
    return view('welcome');
});

// Route::get('/reservation-settings', [SettingsController::class,'index'])->name('reservation-settings');

Route::get('delete_rule/{id}', 'App\Http\Controllers\SettingsController@deleteRule')->name('delete_rule');
Route::get('edit_rule/{id}', 'App\Http\Controllers\SettingsController@editRule')->name('edit_rule');

Route::get('reservation-settings', 'App\Http\Controllers\SettingsController@index')->name('reservation-settings');

Route::get('add_rule', 'App\Http\Controllers\SettingsController@addRule');
Route::post('add_new_reservation_rule', 'App\Http\Controllers\SettingsController@addNewRule')->name('add_new_reservation_rule');
Route::post('edit_reservation_rule', 'App\Http\Controllers\SettingsController@editSingleRule')->name('edit_reservation_rule');


Route::get('reservations', 'App\Http\Controllers\ReservationController@index')->name('reservations');
Route::get('add_reservation', 'App\Http\Controllers\ReservationController@addReservation');
Route::post('add_new_reservation', 'App\Http\Controllers\ReservationController@addNewReservation')->name('add_new_reservation');