<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/books', BookController::class . '@index')->name('books');

Route::post('/books', BookController::class . '@store');

Route::delete('/book/{id}', [BookController::class , 'destroy'])->name('book-destroy');

Route::get('/book/{id}', [BookController::class , 'show'])->name('book-edit');

Route::patch('/book/{id}', [BookController::class , 'update'])->name('book-update');

// Categories
Route::resource('categories', CategoryController::class);
