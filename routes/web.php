<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RatingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/rate-book', function () {
    return view('rate-book');
});

Route::get('/book-list', function () {
    return view('book-list');
});

Route::get('/top-authors', function () {
    return view('top-authors');
});

Route::get('/authors', [AuthorController::class,'getAuthors']);

Route::get('/author/femous', [AuthorController::class,'getFemouseAuthors']);

Route::get('/author/{id}/books', [AuthorController::class,'getBooks']);

Route::get('/book/{id}/author', [BookController::class,'getAuthor']);

Route::get('/books', [BookController::class,'getBooks']);

Route::get('/books-authors', [BookController::class,'getBooksAndAuthors']);

Route::get('/book', [BookController::class,'searchBooks']);

Route::post('/book/{id}/rating', [RatingController::class,'createRating']);




