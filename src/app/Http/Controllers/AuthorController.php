<?php

namespace App\Http\Controllers;

use App\Services\SymfonySkeletonService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

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

    public function load(int $page = 1): array
    {
        return SymfonySkeletonService::getAuthors($page)->json();
    }

    public function show(string $id)
    {
        if (!ctype_digit($id)) {
            return redirect('/authors');
        }

        $response = SymfonySkeletonService::getAuthor($id);

        if ($response->successful()) {
            return view('pages.author', ['author' => $response]);
        } else {
            return redirect('/authors');
        }
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
