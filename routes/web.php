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

Route::get('getProducts', 'HomeController@getProducts');
Route::get('/productShow/{product}', 'HomeController@ProductShow')->name('productShow');
Route::get('/marketShow/{market}', 'HomeController@MarketShow')->name('marketShow');
Route::get('markets/{market}/products', 'MarketController@MarketProducts')->name('markets.products');
Route::post('markets/addProduct', 'MarketController@addProduct');
Route::post('markets/removeProduct', 'MarketController@removeProduct');
Route::get('market-all', 'HomeController@markets')->name('markets');
Route::get('category-all', 'HomeController@categories')->name('categories');
Route::get('category-all/{category}/show', 'HomeController@categoryShow')->name('category-show');

Route::get('/search', 'SearchController@search')->name('search');
Route::post('/getNearestMarkets/', 'SearchController@nearest')->name('nearest');

Route::group(['middleware' => 'basket_is_not_empty'], function (){
    Route::get('basket', 'BasketController@basket')->name('basket');
    Route::get('basket/place', 'BasketController@basketPlace')->name('basketPlace');
    Route::post('basket/remove/{product}', 'BasketController@basketRemove')->name('basketRemove');
    Route::post('basket/place', 'BasketController@basketConfirm')->name('basketConfirm');
});
Route::post('/basket/add/{product}', 'BasketController@basketAdd')->name('basketAdd');
Route::get('/orders', 'OrderController@index')->name('orders.index');
Route::get('/order/{order}', 'OrderController@show')->name('orders.show');
Route::get('/incomingOrders', 'OrderController@incomingOrders')->name('incomingOrders');
Route::get('incomingOrderShow/{order}', 'OrderController@incomingOrderShow')->name('incomingOrderShow');

Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');


Route::get('/getBasket', 'BasketController@getBasketForAjax');
//Route::get('/getCountOfProducts', 'BasketController@getCountOfProducts');

Route::get('/getCategories', 'CategoriesController@getCategories');
Route::get('/getProducts', 'HomeController@getProducts');
Route::post('/uploadImageForProduct', 'ProductsController@image');
Route::get('/getIncomingOrders', 'OrderController@getIncomingOrders');
Route::get('/vue', function (){
    return view('vue');
});


Route::get('/statistic', 'StatisticController@index')->name('statistic');
Route::get('/getStatistic', 'StatisticController@getStatistic');
Route::get('/getTopTrendingProducts', 'StatisticController@getTopTrendingProducts');
