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
    public function index(string $page = null): View
    {
        if (ctype_digit($page)) {
            $page = max($page, 1);
        } else {
            $page = 1;
        }

        return view('pages.authors', [
            'page' => $page,
            'response' => SymfonySkeletonService::getAuthors($page)->json(),
        ]);
    }

    public function load(int $page = 1)
    {
        return SymfonySkeletonService::getAuthors($page)->json();
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

    public function show(string $id): View
    {
        return view('pages.author', ['author' => SymfonySkeletonService::getAuthor($id)]);
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
        $response = SymfonySkeletonService::getAuthor($id);

        if ($response->successful()) {
            if (isset($response->json()['books']) && count($response->json()['books']) > 0) {
                return back()->withErrors(['hasBooks' => true]);
            } else {
                if (SymfonySkeletonService::deleteAuthor($id)->successful()) {
                    return back();
                }
            }
        }

        return back()->withErrors(['error' => true]);
    }
}
