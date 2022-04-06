<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class BannerController extends Controller
{
    public function index()
    {
        $data = $this->getBanner();
        return view('banner', [
            'title' => 'banner',
            'banner' => $data
        ]);
    }

    public function getBanner()
    {
        $token = session('token');
        $response = $response = Http::withToken($token)->get('http://127.0.0.1:8080/api/banner');
        return json_decode($response, true);
    }

    public function postBanner(Request $request)
    {
        $token = session('token');

        $file = $request->file('image');
        $name = $file->getClientOriginalName();

        $response = Http::withToken($token)->acceptJson()->attach('image', file_get_contents($file), $name)->post('http://127.0.0.1:8080/api/banner', [
            'title' => $request->judul,
            'caption' => $request->keterangan,
            'author' => $request->pembuat,
        ]);

        if($response->successful()){
            return redirect()->back()->with('success', 'banner berhasil ditambahkan');
        } else {
            return redirect()->back()->withErrors($response['message']);
        }
    }

    public function updateBanner(Request $request)
    {
        $token = session('token');
        $response = Http::withToken($token)->put('http://127.0.0.1:8080/api/banner/'.$request->id, [
            'title' => $request->judul,
            'caption' => $request->keterangan,
            'author' => $request->pembuat,
        ]);

        if($response->successful()){
            return redirect()->back()->with('success', 'banner berhasil diupdate');
        } else {
            return redirect()->back()->withErrors('error');
        }
    }

    public function deleteBanner(Request $request)
    {
        $token = session('token');
        $response = Http::withToken($token)->delete('http://127.0.0.1:8080/api/banner/'.$request->id);

        if($response->successful()){
            return redirect()->back()->with('success', 'banner berhasil dihapus');
        } else {
            return redirect()->back()->withErrors('error');
        }
    }
    
    
}
