<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\TvShowController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;

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

Route::get('/', WelcomeController::class)->name('welcome');

Auth::routes();

Route::get('/about', AboutController::class)->name('about');

Route::get('/people', [PersonController::class, 'index']);
Route::get('people/{id}', [PersonController::class, 'show']);

Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/{id}', [MovieController::class, 'show']);

Route::get('/tvshow', [TvShowController::class, 'index']);
Route::get('/tvshow/{id}', [TvShowController::class, 'show']);

Route::resource('/profiles', ProfileController::class)->parameters(['profiles' => 'user:id']);

Route::resource('/users', UserController::class);

Route::get('/list', function(){
    return view('pages.list.user_list');
});
