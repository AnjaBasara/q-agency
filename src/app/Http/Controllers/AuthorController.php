<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Services\SymfonySkeletonService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    public function index(): View
    {
        return view('pages.authors', ['response' => SymfonySkeletonService::getAuthors()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Author $author
     * @return Response
     */
    public function show(Author $author)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Author $author
     * @return Response
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Author $author
     * @return Response
     */
    public function update(Request $request, Author $author)
    {
        //
    }

    public function destroy(string $id): RedirectResponse
    {
        $author = SymfonySkeletonService::getAuthor($id);

        if (isset($author['books']) && count($author['books']) > 0) {
            return back()->withErrors(['hasBooks' => true]);
        } else {
            if (SymfonySkeletonService::deleteAuthor($id)) {
                return redirect('/authors');
            } else {
                return back()->withErrors(['error' => true]);
            }
        }
    }
}
