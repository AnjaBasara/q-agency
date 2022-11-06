<?php

namespace App\Services;

use Exception;
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

    public static function getAuthors()
    {
        try {
            $response = Http::withOptions(['verify' => false])
                ->withToken(Session::get('token'))
                ->get(self::API_URL . '/authors');

            return $response->json();
        } catch (Exception $e) {
            return false;
        }
    }

    public static function getAuthor(string $id)
    {
        try {
            $response = Http::withOptions(['verify' => false])
                ->withToken(Session::get('token'))
                ->get(self::API_URL . '/authors/' . $id);

            return $response->json();
        } catch (Exception $e) {
            return false;
        }
    }

    public static function deleteAuthor(string $id): bool
    {
        try {
            Http::withOptions(['verify' => false])
                ->withToken(Session::get('token'))
                ->delete(self::API_URL . '/authors/' . $id);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function deleteBook(string $id): bool
    {
        try {
            Http::withOptions(['verify' => false])
                ->withToken(Session::get('token'))
                ->delete(self::API_URL . '/books/' . $id);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
