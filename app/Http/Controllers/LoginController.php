<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            if (Auth::user()->role == 'kaprodi') {
                return redirect('kaprodi/kaprodi');
            } elseif (Auth::user()->role == 'dosen') {
                return redirect('kaprodi/dosen');
            } elseif (Auth::user()->role == 'dosen_wali') {
                return redirect('kaprodi/dosen_wali');
            } elseif (Auth::user()->role == 'mahasiswa') {
                return redirect('kaprodi/mahasiswa');
            }
        } else {
            return redirect('')->withErrors('Email dan Password yang dimasukan tidak sesuai')->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('');
    }
}
