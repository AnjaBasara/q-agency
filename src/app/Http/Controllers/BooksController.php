<?php

namespace App\Http\Controllers;

use App\Services\SymfonySkeletonService;
use Illuminate\Http\RedirectResponse;

class BooksController extends Controller
{

    public function create()
    {
        //
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
