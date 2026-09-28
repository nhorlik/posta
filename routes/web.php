<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountyController;
use App\Http\Controllers\CityController;

Route::get('/', function () {
    return redirect()->route('counties.index');
});

Route::resource('counties', CountyController::class);
Route::resource('cities', CityController::class);