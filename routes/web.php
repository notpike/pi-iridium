<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\IridiumController;
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

// // Files Auth
// Route::prefix('loot')->middleware('auth')->group(function() {
//     Route::get('{file}', 'fileController@fileStorageServe');
// });


Route::prefix('dashboard')->middleware('auth')->group(function() {
    
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/rpi/shutdown', 'RpiController@shutdown')->name('rpi.shutdown');
    Route::get('/rpi/restart', 'RpiController@restart')->name('rpi.restart');
    Route::resource('/rpi', 'RpiController');


    Route::put('/iridium/startIridium', 'IridiumController@startIridium')->name('iridium.startIridium');
    Route::get('/iridium/stopIridium', 'IridiumController@stopIridium')->name('iridium.stopIridium');

    Route::put('/iridium/startDecode', 'IridiumController@startDecode')->name('iridium.startDecode');
    Route::get('/iridium/stopDecode', 'IridiumController@stopDecode')->name('iridium.stopDecode');

    Route::put('/iridium/startVoice', 'IridiumController@startVoice')->name('iridium.startVoice');
    Route::get('/iridium/stopVoice', 'IridiumController@stopVoice')->name('iridium.stopVoice');

    Route::get('/iridium/readIridium', 'IridiumController@readIridium')->name('iridium.readIridium');
    Route::resource('/iridium', 'IridiumController');

    // Route::delete('/capture/destroy', 'CaptureController@destroy')->name('capture.destroy');
    Route::resource('/capture', 'CaptureController');

    Route::get('/changePassword','HomeController@showChangePasswordForm')->name('changePasswordView');
    Route::post('/changePassword','HomeController@changePassword')->name('changePassword');

});
