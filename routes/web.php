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

Route::post('/gelentekliffiyatver', 'DashBoardController@gelentekliffiyatver')->name('gelentekliffiyatver');

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


//TAMAMLANAN ROUTE BAŞLANGIÇ
Route::get('/tamamlanansil/{id}', 'DashBoardController@tamamlanansil')->name('tamamlanansil');
Route::get('/tamamlananedit/{id}', 'DashBoardController@tamamlananedit')->name('tamamlananedit');
Route::post('/tamamlananupdate/{id}', 'DashBoardController@tamamlananupdate')->name('tamamlananupdate');
Route::get('/tamamlananyazdir/{id}', 'DashBoardController@tamamlananyazdir')->name('tamamlananyazdir');



Route::get('/yeniisekle', 'DashBoardController@yeniisekle')->name('yeniisekle');
Route::post('/isekle', 'DashBoardController@isekle')->name('isekle');

// TERCUMANLAR ROUTE
Route::get('/tercumanekle', 'DashBoardController@tercumanekle')->name('tercumanekle');
Route::get('/tumtercumanlar', 'DashBoardController@tumtercumanlar')->name('tumtercumanlar');
Route::post('/vttercumanekle', 'DashBoardController@vttercumanekle')->name('vttercumanekle');
Route::get('tercumanbasvurulari', 'DashBoardController@tercumanbasvurulari')->name('tercumanbasvurulari');
Route::get('tercumanbasvurusil/{id}', 'DashBoardController@tercumanbasvurusil')->name('tercumanbasvurusil');
Route::post('tercumanbasvuruonayla', 'DashBoardController@tercumanbasvuruonayla')->name('tercumanbasvuruonayla');
Route::get('/tercumanmaliyet', 'DashBoardController@tercumanmaliyet')->name('tercumanmaliyet');

Route::post('maliyetara', 'DashBoardController@maliyetara')->name('maliyetara');
Route::post('tercumanara', 'DashBoardController@tercumanara')->name('tercumanara');

//TERCUMANLAR İŞ TAKİP ROUTE

Route::get('/tercumanistakipekle', 'DashBoardController@tercumanistakipekle')->name('tercumanistakipekle');
Route::post('/tercumanformistakipekle', 'DashBoardController@tercumanformistakipekle')->name('tercumanformistakipekle');
Route::get('/tercumanistakipcetveli', 'DashBoardController@tercumanistakipcetveli')->name('tercumanistakipcetveli');
Route::get('/tercumanistakipcetvelisil/{id}', 'DashBoardController@tercumanistakipcetvelisil')->name('tercumanistakipcetvelisil');
Route::post('lksekle', 'DashBoardController@lksekle')->name('lksekle');

Route::get('/tercumantakipduzenle/{id}', 'DashBoardController@tercumantakipduzenle')->name('tercumantakipduzenle');

Route::post('istakipupdate/{id}', 'DashBoardController@istakipupdate')->name('istakipupdate');

Route::get('/lksyeeklenenler', 'DashBoardController@lksyeeklenenler')->name('lksyeeklenenler');

Route::post('lksara', 'DashBoardController@lksara')->name('lksara');


Route::get('idgonder/{id}', 'DashBoardController@idgonder')->name('idgonder');





Route::get('test', 'DashBoardController@test')->name('test');



});
