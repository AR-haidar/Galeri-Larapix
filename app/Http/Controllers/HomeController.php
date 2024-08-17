<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function isi()
    {
        $foto = DB::table('foto')
            ->join('users', 'users.id', '=', 'foto.user_id')
            ->join('album', 'album.album_id', '=', 'foto.album_id')
            ->select('users.username', 'users.profile', 'foto.*', 'album.nama_album')
            ->orderBy('foto.created_at', 'desc')
            // ->inRandomOrder()
            ->take(10)
            ->get();
        return view('page.home.isi-home')->with([
            "foto" => $foto,
            "x" => null
        ]);
    }

    public function index()
    {
        return view('page.home.home');
    }
}
