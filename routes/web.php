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



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('products', 'ProductsController');
Route::resource('categories', 'CategoriesController');
Route::resource('markets', 'MarketController');
Route::get('markets/{market}/products', 'MarketController@MarketProducts')->name('markets.products');
Route::post('markets/addProduct', 'MarketController@addProduct');
Route::post('markets/removeProduct', 'MarketController@removeProduct');
Route::get('market-all', 'HomeController@markets')->name('markets');
Route::get('category-all', 'HomeController@categories')->name('categories');
Route::get('category-all/{category}/show', 'HomeController@categoryShow')->name('category-show');
Route::get('/search', 'SearchController@search')->name('search');
Route::post('/getNearestMarkets/', 'SearchController@nearest')->name('nearest');
