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
        $response = Http::post(env('BASE_URL').'/api/login', [
            'password' => $request->password,
            'email' => $request->email,
        ]);

        if($response->successful()){
            session(['token' => $response->collect()['token']]);
            $this->getUser();
            return redirect()->action([AuthController::class, 'index']);
        } else {
            return redirect('/')->withInput()->withErrors($response['message']);
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
        $response = Http::withToken($token)->get(env('BASE_URL').'/api/user');
        session(['user' => $response->collect()]);
        session(['name' => $response->collect()['name']]);
    }
}
