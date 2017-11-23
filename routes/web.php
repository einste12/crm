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


});
