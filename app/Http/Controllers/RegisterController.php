<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8080/api/register', [
            'name' => $request->name,
            'password' => $request->password,
            'address' => $request->address,
            'email' => $request->email,
            'role' => "admin"
        ]);

        if($response->successful()){
            return redirect()->action([RegisterController::class, 'index']);
        } else {
            Log::info('failed');
        }
    }
}