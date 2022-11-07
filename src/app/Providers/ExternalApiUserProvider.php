<?php

namespace App\Providers;

use App\Services\SymfonySkeletonService;
use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Session;

class ExternalApiUserProvider implements UserProvider
{

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param mixed $identifier
     * @return Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        return new GenericUser([
            'id' => $identifier,
            'email' => $identifier,
            'name' => Session::get('user'),
            'remember_token' => '',
        ]);
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param mixed $identifier
     * @param string $token
     * @return Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        return null;
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param Authenticatable $user
     * @param string $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        //
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param array $credentials
     * @return Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (!array_key_exists('email', $credentials) || !array_key_exists('password', $credentials)) {
            return null;
        }

        $response = SymfonySkeletonService::authenticate($credentials['email'], $credentials['password']);

        if ($response->failed()) {
            return null;
        }

        $payload = $response->json();
        Session::put('token', $payload['token_key']);
        Session::put('user', $payload['user']['first_name'] . ' ' . $payload['user']['last_name']);

        return new GenericUser($payload);
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param Authenticatable $user
     * @param array $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return true;
    }
}
