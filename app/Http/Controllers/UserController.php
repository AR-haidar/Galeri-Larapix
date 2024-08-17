<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function foto($id)
    {
        $user =  DB::table('users')
            ->where('id', $id)
            ->get();
        return view('page.user.foto')->with([
            "user"          => $user,
            "jumlah_foto"   => DB::table('foto')
                ->where('user_id', '=', $id)
                ->count(),
            "jumlah_album"  => DB::table('album')
                ->where('user_id', '=', $id)
                ->count(),
            "foto"  => DB::table('foto')
                ->where('user_id', '=', $id)
                ->get(),
        ]);
    }


    public function album($id)
    {
        $album = DB::table('album')
            ->leftJoin('foto', 'foto.album_id', '=', 'album.album_id')
            ->groupBy('album.album_id')
            ->where('album.user_id', '=', $id)
            ->select('album.album_id', 'foto.lokasi_file', 'album.nama_album')
            ->get();
        $user =  DB::table('users')
            ->where('id', $id)
            ->get();
        return view('page.user.album')->with([
            "user" => $user,
            "jumlah_foto"   => DB::table('foto')
                ->where('user_id', '=', $id)
                ->count(),
            "jumlah_album"  => DB::table('album')
                ->where('user_id', '=', $id)
                ->count(),
            "album"         => $album
        ]);
    }
}
