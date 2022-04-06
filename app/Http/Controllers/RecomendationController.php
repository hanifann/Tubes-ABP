<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class RecomendationController extends Controller
{
    public function index()
    {
        $data = $this->getRecomendation();
        return view('artikel', [
            'title' => 'artikel',
            'artikel' => $data
        ]);
    }

    public function getRecomendation()
    {
        $token = session('token');
        $response = $response = Http::withToken($token)->get('http://127.0.0.1:8080/api/recomendation');
        return json_decode($response, true);
    }

    public function postRecomendation(Request $request)
    {
        $token = session('token');

        $file = $request->file('image');
        $name = $file->getClientOriginalName();

        $response = Http::withToken($token)->acceptJson()->attach('image', file_get_contents($file), $name)->post('http://127.0.0.1:8080/api/recomendation', [
            'title' => $request->judul,
            'content' => $request->konten,
            'author' => $request->pembuat,
        ]);

        if($response->successful()){
            return redirect()->back()->with('success', 'Recomendation berhasil ditambahkan');
        } else {
            return redirect()->back()->withErrors($response['message']);
        }
    }

    public function updateRecomendation(Request $request)
    {
        $token = session('token');
        
        $response = Http::withToken($token)->put('http://127.0.0.1:8080/api/recomendation/'.$request->id, [
            'title' => $request->judul,
            'content' => $request->konten,
        ]);

        if($response->successful()){
            return redirect()->back()->with('success', 'Recomendation berhasil diupdate');
        } else {
            return redirect()->back()->withErrors('error');
        }
    }

    public function deleteRecomendation(Request $request)
    {
        $token = session('token');
        $response = Http::withToken($token)->delete('http://127.0.0.1:8080/api/recomendation/'.$request->id);

        if($response->successful()){
            return redirect()->back()->with('success', 'Recomendation berhasil dihapus');
        } else {
            return redirect()->back()->withErrors('error');
        }
    }
    
    
}
