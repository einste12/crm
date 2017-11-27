<?php

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



    return view('auth.login');
});


Route::get('/logout', function () {
  Auth::logout();
  Session::flush();

 return Redirect::route('login');
});




Auth::routes();

Route::group(['middleware' => 'auth'], function()
{
Route::get('/onaybekleyen', 'DashBoardController@onaybekleyen')->name('onaybekleyen');
Route::get('/dashboard', 'DashBoardController@index')->name('dashboard');
Route::get('/devameden', 'DashBoardController@devameden')->name('devameden');
Route::get('/tamamlanan', 'DashBoardController@tamamlanan')->name('tamamlanan');
Route::get('/iptalteklif', 'DashBoardController@iptalteklif')->name('iptalteklif');

Route::post('/gelenteklifonayla', 'DashBoardController@gelenteklifonayla')->name('gelenteklifonayla');

Route::get('/onaybekleyensil/{id}', 'DashBoardController@onaybekleyensil')->name('onaybekleyensil');
Route::get('/gelenteklifsil/{id}', 'DashBoardController@gelenteklifsil')->name('gelenteklifsil');

Route::get('/onaybekleyenedit/{id}', 'DashBoardController@onaybekleyenedit')->name('onaybekleyenedit');
Route::get('/onaybekleyenyazdir/{id}', 'DashBoardController@onaybekleyenyazdir')->name('onaybekleyenyazdir');
Route::post('/onaybekleyenupdate/{id}', 'DashBoardController@onaybekleyenupdate')->name('onaybekleyenupdate');

//DEVAM EDEN ROUTE BAŞLANGIÇ
Route::post('/tekliftamamla', 'DashBoardController@tekliftamamla')->name('tekliftamamla');
Route::get('/devamedensil/{id}', 'DashBoardController@devamedensil')->name('devamedensil');
Route::get('/devamedenedit/{id}', 'DashBoardController@devamedenedit')->name('devamedenedit');
Route::post('/devamedenupdate/{id}', 'DashBoardController@devamedenupdate')->name('devamedenupdate');
Route::get('/devamedenyazdir/{id}', 'DashBoardController@devamedenyazdir')->name('devamedenyazdir');



});
