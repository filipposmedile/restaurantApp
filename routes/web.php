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


Route::get('/admin', function () {
    return view('admin');
});

Auth::routes();

Route::get('/', 'Tasks@homepage')->name('homepage');

Route::get('/menu', 'Tasks@prices')->name('menu');

Route::post('/email','Tasks@email')->name('email');

Route::middleware('auth')->group(function(){

    Route::get('/linkstorage', function () {
        Artisan::call('storage:link');
    });

    Route::get('/home', 'Tasks@caricamentoPublic')->name('home');
    

    Route::get('/home/categories','HomeController@categories')->name('categories');
    Route::post('/home/categories/add','CategoryController@add')->name('category.add');
    Route::delete('home/cetegories/{id}/delete','CategoryController@delete')->name('category.delete');
    Route::post('home/cetegories/{id}/edit','CategoryController@edit')->name('category.edit');
    
    Route::get('/home/products','HomeController@products')->name('products');
    Route::get('/home/products/{category}/add','ProductController@addProduct')->name('product.add');
    Route::post('/home/products/{id}/store','ProductController@store')->name('product.store');
    Route::post('/home/products/{id}/update','ProductController@update')->name('product.update');
    Route::post('/home/products/{id}/delete','ProductController@delete')->name('product.delete');
    
    Route::get('/home/images','HomeController@pictures')->name('pictures');
    Route::post('/home/images/store','ImageController@store')->name('pictures.store');
    Route::post('/home/images/{id}/update','ImageController@update')->name('pictures.update');
    Route::delete('/home/images/{id}/delete','ImageController@delete')->name('pictures.delete');

    Route::post('/home/icons/store','IconController@store')->name('icons.store');
    Route::delete('/home/icons/{id}/delete','IconController@delete')->name('icons.delete');
    Route::post('/home/icons/{id}/update','IconController@update')->name('icons.update');

    Route::get('/home/setup','HomeController@setup')->name('setup');
    Route::post('/home/setup/save','HomeController@setupSave')->name('setup.save');
    Route::post('/home/setup/deleteLogoBackground','HomeController@deleteLogoBackground')->name('setup.deleteLogoBackground');

    
});

