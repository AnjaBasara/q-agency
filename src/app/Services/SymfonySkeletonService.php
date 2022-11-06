<?php

namespace App\Services;

use App\Models\Book;
use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class SymfonySkeletonService
{
    private const API_URL = 'https://symfony-skeleton.q-tests.com/api/v2';

    public static function authenticate($email, $password)
    {
        try {
            $response = Http::withOptions([
                'verify' => false,
            ])->post(self::API_URL . '/token', [
                'email' => $email,
                'password' => $password,
            ]);

            return $response->json();
        } catch (Exception $e) {
            return false;
        }
    }

    public static function getAuthors(): Response
    {
        return Http::withOptions(['verify' => false])
            ->withToken(Session::get('token'))
            ->get(self::API_URL . '/authors');
    }

    public static function getAuthor(string $id): Response
    {
        return Http::withOptions(['verify' => false])
            ->withToken(Session::get('token'))
            ->get(self::API_URL . '/authors/' . $id);
    }

    public static function deleteAuthor(string $id): Response
    {
        return Http::withOptions(['verify' => false])
            ->withToken(Session::get('token'))
            ->delete(self::API_URL . '/authors/' . $id);
    }

    public static function deleteBook(string $id): Response
    {
        return Http::withOptions(['verify' => false])
            ->withToken(Session::get('token'))
            ->delete(self::API_URL . '/books/' . $id);
    }

    public static function createBook(Book $book): Response
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
