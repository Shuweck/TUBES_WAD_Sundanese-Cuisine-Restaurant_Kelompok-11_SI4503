<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function pengelola()
    {
        return view('pages.login.index');
    }


    public function pengelolaAuth(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }elseif(Auth::user()->role == 'waiter'){
                return redirect()->route('waiter.index');
            }elseif(Auth::user()->role == 'chef'){
                return redirect()->route('chef.index');
            }

            return redirect()->route('home');
        }

        return redirect()->route('login.pengelola')->with('error', 'Email atau password salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }


}
