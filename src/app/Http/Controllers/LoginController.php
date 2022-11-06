<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\SymfonySkeletonService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(Request $request): RedirectResponse
    {
        $response = SymfonySkeletonService::authenticate($request->email, $request->password);

        if (array_key_exists('token_key', $response->json())) {
            $user = new User();
            $user->name = $response['user']['first_name'] . ' ' . $response['user']['last_name'];
            $user->email = $response['user']['email'];
            Auth::login($user);
            Session::put('token', $response['token_key']);
            return redirect()->intended('/authors');
        } else {
            return back()->withErrors(['credentials' => true]);
        }
    }
}
