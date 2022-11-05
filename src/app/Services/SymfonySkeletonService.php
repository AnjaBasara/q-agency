<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class SymfonySkeletonService
{
    public static function authenticate($email, $password)
    {
        try {
            $response = Http::withOptions([
                'verify' => false,
            ])->post('https://symfony-skeleton.q-tests.com/api/v2/token', [
                'email' => $email,
                'password' => $password,
            ]);

            return $response->json();
        } catch (Exception $e) {
            return false;
        }
    }
}
