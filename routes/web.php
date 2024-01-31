<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
//use App\Models\User;
use Illuminate\Support\Facades\DB;



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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        //$users = User::all();
        $users = DB::table('users')->get();



        return view('dashboard',compact('users'));
    })->name('dashboard');
});
