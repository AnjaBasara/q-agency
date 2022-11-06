<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Services\SymfonySkeletonService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BooksController extends Controller
{
    public function create(): View
    {
        return view('pages.book', ['response' => SymfonySkeletonService::getAuthors()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $book = new Book($request->all());
        $book->numberOfPages = (int)$request->numberOfPages;

        $author = new Author();
        $author->id = $request->author;

        $book->author = $author;

        if (SymfonySkeletonService::createBook($book)->successful()) {
            return redirect('/authors');
        } else {
            return back()->withErrors(['error' => true]);
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        if (SymfonySkeletonService::deleteBook($id)) {
            return back();
        } else {
            return back()->withErrors(['error' => true]);
        }
    }
}
