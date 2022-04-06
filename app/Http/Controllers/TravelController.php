<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class TravelController extends Controller
{
    public function index()
    {
        $data = $this->getTravel();
        return view('travelling', [
            'title' => 'travelling',
            'travel' => $data
        ]);
    }

    public function getTravel()
    {
        $token = session('token');
        $response = $response = Http::withToken($token)->get('http://127.0.0.1:8080/api/travel');
        return json_decode($response, true);
    }

    public function postTravel(Request $request)
    {
        $token = session('token');

        $file = $request->file('image');
        $name = $file->getClientOriginalName();

        $response = Http::withToken($token)->acceptJson()->attach('image', file_get_contents($file), $name)->post('http://127.0.0.1:8080/api/travel', [
            'title' => $request->judul,
            'price' => $request->harga,
            'description' => $request->deskripsi,
            'startDate' => date('y-m-d', strtotime($request->start)),
            'endDate' => date('y-m-d', strtotime($request->end)),
            'lodging' => $request->penginapan,
            'transportation' => $request->transportasi,
            'image' => $request->image,
        ]);

        if($response->successful()){
            return redirect()->back()->with('success', 'Travel berhasil ditambahkan');
        } else {
            return redirect()->back()->withErrors($response['message']);
        }
    }

    public function updateTravel(Request $request)
    {
        $token = session('token');

        $response = Http::withToken($token)->put('http://127.0.0.1:8080/api/travel/'.$request->id, [
            'title' => $request->judul,
            'price' => $request->harga,
            'description' => $request->deskripsi,
            'startDate' => date('y-m-d', strtotime($request->start)),
            'endDate' => date('y-m-d', strtotime($request->end)),
            'lodging' => $request->penginapan,
            'transportation' => $request->transportasi,
        ]);
        
        if($response->successful()){
            return redirect()->back()->with('success', 'Travel berhasil diupdate');
        } else {
            return redirect()->back()->withErrors('error');
        }
    }

    public function deleteTravel(Request $request)
    {
        $token = session('token');
        $response = Http::withToken($token)->delete('http://127.0.0.1:8080/api/travel/'.$request->id);

        if($response->successful()){
            return redirect()->back()->with('success', 'Travel berhasil dihapus');
        } else {
            return redirect()->back()->withErrors('error');
        }
    }
    
    
}
