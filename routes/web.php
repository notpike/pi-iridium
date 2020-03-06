<?php

use App\Http\Controllers\HomeController;
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


// Auth Regiser
// Auth::routes();
Auth::routes(['register' => false]);


Route::prefix('dashboard')->middleware('auth')->group(function() {
    
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/rpi/shutdown', 'RpiController@shutdown')->name('rpi.shutdown');
    Route::get('/rpi/restart', 'RpiController@restart')->name('rpi.restart');
    Route::resource('/rpi', 'RpiController');


    Route::resource('/iridium', 'IridiumController');

});
