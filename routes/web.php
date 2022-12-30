<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AuthAdmin;
use App\Http\Middleware\AuthGuest;
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

Route::get('/', [MovieController::class, 'index'])->name('home');
Route::prefix('/movie')->middleware([AuthAdmin::class])->group(function () {
    Route::get('/add', [MovieController::class, 'create'])->name('create-movie');
    Route::post('/add', [MovieController::class, 'validateCreate'])->name('validate-create-movie');
    Route::get('/edit/{id}', [MovieController::class, 'edit'])->name('edit-movie');
    Route::post('/edit/{id}', [MovieController::class, 'validateEdit'])->name("validate-edit-movie");
    Route::get('/detail/{id}', [MovieController::class, 'detail'])->name('movie-detail')->withoutMiddleware([AuthAdmin::class]);
    Route::delete('/delete/{id}', [MovieController::class, 'delete'])->name('delete-movie');
});

Route::prefix('/login')->middleware([AuthGuest::class])->group(function () {
    Route::get('/', [AuthController::class, 'loginView'])->name('login');
    Route::post('/', [AuthController::class, 'loginAuth'])->name('validate-login');
});

Route::prefix('/register')->middleware([AuthGuest::class])->group(function () {
    Route::get('/', [AuthController::class, 'register'])->name('register');
    Route::post('/', [AuthController::class, 'registerAuth'])->name('validate-register');
});


Route::prefix('/profile')->middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'profile'])->name('view-profile');
    Route::put('/', [UserController::class, 'update'])->name('validate-edit-profile');
});

Route::prefix('/watchlist')->middleware('auth')->group(function () {
    Route::post('/modify/{id}', [WatchListController::class, 'modify'])->name('modify');
    Route::get('/', [WatchListController::class, 'index'])->name('show-watchlist');
    Route::post('/{movie}/{page}', [WatchListController::class, 'action'])->name('action-watchlist');
});

Route::prefix('/actor')->middleware([AuthAdmin::class])->group(function () {
    Route::get('/', [ActorController::class, 'index'])->name('show-actor')->withoutMiddleware([AuthAdmin::class]);
    Route::get('/add', [ActorController::class, 'add'])->name('add-actor');
    Route::post('/add', [ActorController::class, 'validateAdd'])->name('validate-add-actor');
    Route::get('/edit/{actor}', [ActorController::class, 'edit'])->name('edit-actor');
    Route::put('/edit/{actor}', [ActorController::class, 'validateEdit'])->name('validate-edit-actor');
    Route::get("/detail/{actor}", [ActorController::class, 'detail'])->name('actor-detail')->withoutMiddleware([AuthAdmin::class]);
    Route::delete('/delete/{actor}', [ActorController::class, 'destroy'])->name('delete-actor');
});
