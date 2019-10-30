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
    return view('welcome');
});

Route::get('/products', 'ProductController@index')->name('products.home')->middleware('auth');
Route::get('/products/create', 'ProductController@create')->name('products.create')->middleware('auth');
Route::post('/products', 'ProductController@store')->name('products.store')->middleware('auth');
Route::get('/products/{product}', 'ProductController@edit')->name('products.edit')->middleware('auth');
Route::put('/products/{product}', 'ProductController@update')->name('products.update')->middleware('auth');
Route::delete('/products/{product}','ProductController@destroy')->name('products.destroy')->middleware('auth');

Route::get('/dependences','DependenceController@index')->name('dependences.home')->middleware('auth');
Route::get('/dependences/create','DependenceController@create')->name('dependences.create')->middleware('auth');
Route::post('/dependences','DependenceController@store')->name('dependences.store')->middleware('auth');
Route::get('/dependences/{dependence}','DependenceController@edit')->name('dependences.edit')->middleware('auth');
Route::put('/dependences/{dependence}','DependenceController@update')->name('dependences.update')->middleware('auth');


Route::get('/transactions/deliver', 'TransactionController@deliver')->name('transactions.deliver')->middleware('auth');
Route::get('/transactions/devolucion', 'TransactionController@return')->name('transactions.return')->middleware('auth');

Route::get('/orders','OrderController@index')->name('orders.home')->middleware('auth');
Route::get('/orders/{order}','OrderController@show')->name('orders.show')->middleware('auth');

Route::get('/reportes','ReportController@index')->name('reports.home');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
