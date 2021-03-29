<?php


Auth::routes();


// front content
Route::get('/', 'FrontController@index')->name('index');
Route::get('cart', 'FrontController@cart')->name('cart');
Route::get('/product/{id}', 'FrontController@view')->name('view');
Route::get('/catalog/{id?}', 'FrontController@catalog')->name('catalog');
Route::get('add-to-cart/{id}', 'FrontController@addToCart')->name('addToCart');
Route::get('search', 'FrontController@search')->name('search');

// for ajax
Route::patch('update-cart', 'FrontController@update');
Route::delete('remove-from-cart', 'FrontController@remove');

Route::get('/home', 'HomeController@index')->name('home');


// edit group
Route::group(['middleware' => ['auth']], function () {

    Route::group(['prefix' => 'edit-product'], function () {
        Route::get('/', 'Backend\ProductsController@index')->name('edit-product.index');
        Route::post('/', 'Backend\ProductsController@store')->name('edit-product.store');
        Route::get('/{id}', 'Backend\ProductsController@edit')->name('edit-product.edit');
        Route::patch('/{id}', 'Backend\ProductsController@update')->name('edit-product.update');
        Route::delete('/{id}', 'Backend\ProductsController@destroy')->name('edit-product.delete');
    });

    Route::group(['prefix' => 'edit-categories'], function () {
        Route::get('/', 'Backend\CategoriesController@index')->name('edit-categories.index');
        Route::post('/', 'Backend\CategoriesController@store')->name('edit-categories.store');
        Route::get('/{id}', 'Backend\CategoriesController@edit')->name('edit-categories.edit');
        Route::patch('/{id}', 'Backend\CategoriesController@update')->name('edit-categories.update');
        Route::delete('/{id}', 'Backend\CategoriesController@destroy')->name('edit-categories.delete');
    });

});


