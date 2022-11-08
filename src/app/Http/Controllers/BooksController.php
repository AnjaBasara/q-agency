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
    private SymfonySkeletonService $service;

    public function __construct(SymfonySkeletonService $service)
    {
        $this->service = $service;
    }
    public function create(): View
    {
        return view('pages.book', ['response' => $this->service->getAuthors()->json()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $book = new Book($request->all());
        $book->numberOfPages = (int)$request->numberOfPages;

        $author = new Author();
        $author->id = $request->author;

        $book->author = $author;

        if ($this->service->createBook($book)->successful()) {
            return redirect('/authors');
        } else {
            return back()->withErrors(['error' => true]);
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        if ($this->service->deleteBook($id)->successful()) {
            return back();
        } else {
            return back()->withErrors(['error' => true]);
        }
    }
}
