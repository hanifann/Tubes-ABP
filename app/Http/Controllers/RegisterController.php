<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $response = Http::post(env('BASE_URL').'/api/register', [
            'name' => $request->name,
            'password' => $request->password,
            'address' => $request->address,
            'email' => $request->email,
            'role' => "admin"
        ]);

        if($response->successful()){
            return redirect('register')->with('success', 'Akun berhasil dibuat silahkan login');
        } else {
            return redirect('register')->withErrors($response['message']);
        }
    }
}
