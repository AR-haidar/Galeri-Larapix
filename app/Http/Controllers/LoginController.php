<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function signinPage()
    {
        return view('sign.signin');
    }

    public function signupPage()
    {
        return view('sign.signup');
    }

    public function signin(Request $request)
    {
        $loginType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $login = [
            $loginType => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($login)) {

            $request->session()->regenerate();
            return redirect()->intended('/')->with('toast_success', 'Berhasil Login');
        }

        alert()->error('Login Gagal', 'Username atau Password salah')
            ->showConfirmButton('OK', '#ff1c45')
            ->autoClose(4000);

        return redirect()->back();
    }

    public function signup(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ], [
            'username.unique' => 'Username ' . $request->username . ' sudah terpakai',
            'email.unique' => 'Email ' . $request->email . ' sudah terpakai'
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/')->with('toast_success', 'Berhasil membuat akun');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/signin');
    }
}
