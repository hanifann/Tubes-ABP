<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\BannerController;

class AuthController extends Controller
{
    public function index()
    {
        if(session()->has('token')){
            return redirect()->action([BannerController::class, 'index']);
        } else {
            return view('login');
        }
    }

    public function login(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8080/api/login', [
            'password' => $request->password,
            'email' => $request->email,
        ]);

        if($response->successful()){
            session(['token' => $response->collect()['token']]);
            $this->getUser();
            return redirect()->action([AuthController::class, 'index']);
        } else {
            return redirect('/')->withErrors('wrong username or password');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect()->action([AuthController::class, 'index']);
    }

    public function getUser()
    {   
        $token = session('token');
        $response = Http::withToken($token)->get('http://127.0.0.1:8080/api/user');
        session(['name' => $response->collect()['name']]);
    }
}
