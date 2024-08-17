<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CariController extends Controller
{
    public function cari()
    {
        return redirect('/cari/user');
    }

    public function carialbum(Request $request)
    {
        $key = $request->key;
        $album = DB::select("SELECT 
        album.album_id,
        album.nama_album,
        album.created_at,
        users.username,
        users.nama_lengkap,
        COUNT(DISTINCT foto.id) AS jumlah_foto,
        MIN(foto.lokasi_file) AS lokasi_file
            FROM 
                album
            INNER JOIN
                users ON users.id = album.user_id
            LEFT JOIN 
                foto ON album.album_id = foto.album_id
            WHERE
                album.album_id LIKE '%" . $key . "%' OR
                album.nama_album LIKE '%" . $key . "%'
            GROUP BY 
                album.album_id");

        return view('page.cari.cari-album')->with([
            "album" => $album
        ]);
    }

    public function cariuser(Request $request)
    {
        $key = $request->key;
        $user = DB::table('users')
            ->select('*')
            ->where('users.username', 'like', '%' . $key . '%')
            ->orWhere('nama_lengkap', 'like', '%' . $key . '%')
            ->get();

        return view('page.cari.cari-user')->with([
            "user" => $user
        ]);
    }

    public function carifoto(Request $request)
    {
        $key = $request->key;
        $foto = DB::table('foto')
            ->join('users','users.id','=','foto.user_id')
            ->join('album','album.album_id','=','foto.album_id')
            ->select('foto.*','users.username','users.profile','album.nama_album')
            ->where('foto.judul_foto','like','%'. $key.'%')
            ->orWhere('album.nama_album','like','%'. $key.'%')
            ->orWhere('users.username','like','%'. $key.'%')
            ->inRandomOrder()
            ->limit(15)
            ->get();

        return view('page.cari.cari-foto')->with([
            "foto" => $foto
        ]);
    }
}
