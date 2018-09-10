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
Route::get('/test', 'UserApiController@index');


Route::group(['prefix' => 'subscription'], function(){

    Route::get('/', 'AdminController@allSubscriptions')->name('admin.subscription.all');
    Route::get('single/{id?}', 'AdminController@singleSubscription')->name('admin.subscription.single');
    Route::get('create', 'AdminController@createSubscription')->name('admin.subscription.create');
    Route::post('create', 'AdminController@storeSubscription')->name('admin.subscription.store');
    Route::get('edit/{id?}', 'AdminController@editSubscription')->name('admin.subscription.edit');
    Route::post('edit/{id?}', 'AdminController@updateSubscription')->name('admin.subscription.update');
    Route::get('delete/{id?}', 'AdminController@deleteSubscription')->name('admin.subscription.delete');

    Route::group(['prefix' => 'laws'], function (){

        Route::get('/', 'AdminController@allLaws')->name('admin.laws.all');
        Route::post('all', 'AdminController@getAllLaws')->name('admin.laws.all.post');
        Route::get('single/{id?}', 'AdminController@singleLaws')->name('admin.laws.single');


    });


});