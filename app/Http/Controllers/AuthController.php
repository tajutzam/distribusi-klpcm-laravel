<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function authenticate(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
                'g-recaptcha-response' => 'required|recaptcha'
            ]
        );



        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = User::where('username', $request->username)->first();
            Auth::login($user);
            return redirect('/dashboard');
        }
        return redirect()->back()->withErrors('Silahkan cek username atau password anda!');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
