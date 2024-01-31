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
});
//Route::get('/contact','ContactController@index'); // laravel 7
Route::get('/contactdflksdjfmshsdflmjdsf', [ContactController::class, 'index'])->name('con'); // laravel v8+
