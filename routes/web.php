<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login');
});
Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login');
Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/event', 'App\Http\Controllers\EventController@list');
    Route::get('/event/add', 'App\Http\Controllers\EventController@add');
    Route::post('/event/add', 'App\Http\Controllers\EventController@save');
    Route::get('/event/delete', 'App\Http\Controllers\EventController@delete');
});
