<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function postlogin(Request $request)
    {

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            if (!$user->aktif) {
                return response()->json(['message' => 'Your account has been deactivated'], 403);
            }
            if ($user->level == 'Pelanggan') {
                return redirect('/');
            } elseif ($user->level == 'Administrator' || $user->level == 'Bendahara' || $user->level == 'Pemilik') {
                return redirect('/dashboard');
            }
        }
        return redirect('/login')->with('error', 'Login gagal!');
    }

    public function postregister(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => 'pelanggan',
            'remember_token' => Str::random(60),
        ]);

        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logout berhasil!');
    }
}
