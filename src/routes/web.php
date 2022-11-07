<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\HomeController;
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

Route::middleware(['guest'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/login', [HomeController::class, 'index']);
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Authors
    Route::get('/authors', [AuthorController::class, 'index'])->name('authors');
    Route::get('/authors/page/{page}', [AuthorController::class, 'index'])->name('authors.page');
    Route::get('/authors/load/{page}', [AuthorController::class, 'load'])->name('authors.load');
    Route::get('/authors/{id}/delete', [AuthorController::class, 'destroy'])->name('authors.delete');
    Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('authors.show');

    // Books
    Route::get('/books/create', [BooksController::class, 'create'])->name('books.create');
    Route::post('/books', [BooksController::class, 'store'])->name('books.store');
    Route::get('/books/{id}/delete', [BooksController::class, 'destroy'])->name('books.delete');
});
