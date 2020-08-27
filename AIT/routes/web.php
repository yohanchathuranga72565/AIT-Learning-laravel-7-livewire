<?php

use Illuminate\Http\Request;
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

Route::get('/about','HomePages\AboutController@index')->name('home.about');

Route::get('/contact','HomePages\ContactController@index')->name('home.contact');

Route::get('/', 'HomePages\HomeController@index')->name('home.home');

Route::post('/send-email','HomePages\ContactController@sendEmail' )->name('contact-mail');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
