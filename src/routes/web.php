<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\LoginController;
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

Route::get('/', function () {
    return view('pages.login');
});

Route::post('/login', [LoginController::class, 'login'])->name('login');

// Authors
Route::get('/authors', [AuthorController::class, 'index'])->name('authors');
Route::get('/authors/{id}/delete', [AuthorController::class, 'destroy'])->name('authors.delete');
Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('authors.show');

// Books
Route::get('/books/{id}/delete', [BooksController::class, 'destroy'])->name('books.delete');

