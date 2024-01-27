<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;



Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    echo "this is home page";
});
Route::get('/about', function () {
return view('about');
})->middleware('age');
Route::get('/contact','ContactController@index'); // laravel 7
Route::get('/contact', [ContactController::class, 'index']); // laravel v8+
