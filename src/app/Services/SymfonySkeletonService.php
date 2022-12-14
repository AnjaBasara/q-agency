<?php

namespace App\Services;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class SymfonySkeletonService
{
    private const API_URL = 'https://symfony-skeleton.q-tests.com/api/v2';

    public function authenticate($email, $password): Response
    {
        return Http::withOptions([
            'verify' => false,
        ])->post(self::API_URL . '/token', [
            'email' => $email,
            'password' => $password,
        ]);
    }

    public function getAuthors(int $page = 1): Response
    {
        return Http::withOptions(['verify' => false])
            ->withToken(Session::get('token'))
            ->get(self::API_URL . '/authors?page=' . $page);
    }

    public function getAuthor(string $id): Response
    {
        return Http::withOptions(['verify' => false])
            ->withToken(Session::get('token'))
            ->get(self::API_URL . '/authors/' . $id);
    }

    public function deleteAuthor(string $id): Response
    {
        return Http::withOptions(['verify' => false])
            ->withToken(Session::get('token'))
            ->delete(self::API_URL . '/authors/' . $id);
    }

    public function createAuthor(Author $author): Response
    {
        return Http::withOptions(['verify' => false])
            ->withToken(Session::get('token'))
            ->post(self::API_URL . '/authors', [
                'first_name' => $author->firstName,
                'last_name' => $author->lastName,
                'birthday' => $author->birthday,
                'biography' => $author->biography,
                'gender' => $author->gender,
                'place_of_birth' => $author->placeOfBirth,
            ]);
    }

    public function deleteBook(string $id): Response
    {
        return Http::withOptions(['verify' => false])
            ->withToken(Session::get('token'))
            ->delete(self::API_URL . '/books/' . $id);
    }

    public function createBook(Book $book): Response
    {
        return Http::withOptions(['verify' => false])
            ->withToken(Session::get('token'))
            ->post(self::API_URL . '/books', [
                'author' => $book->author,
                'title' => $book->title,
                'release_date' => $book->releaseDate,
                'description' => $book->description,
                'isbn' => $book->isbn,
                'format' => $book->format,
                'number_of_pages' => $book->numberOfPages,
            ]);
    }
}
