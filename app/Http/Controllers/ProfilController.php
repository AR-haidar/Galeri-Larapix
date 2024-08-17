<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Foto;
use App\Models\Album;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function foto()
    {
        return view('page.profil.foto')->with([
            "jumlah_foto"   => DB::table('foto')
                ->where('user_id', '=', auth()->user()->id)
                ->count(),
            "jumlah_album"  => DB::table('album')
                ->where('user_id', '=', auth()->user()->id)
                ->count(),
            "foto"  => DB::table('foto')
                ->where('user_id', '=', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->get(),
        ]);
    }


    public function album()
    {
        $album = DB::select("SELECT 
            album.album_id,
            album.nama_album,
            album.created_at,
            COUNT(DISTINCT `likefoto`.`id`) AS jumlah_like,
            COUNT(DISTINCT komentarfoto.id) AS jumlah_komen,
            COUNT(DISTINCT foto.id) AS jumlah_foto,
            MIN(foto.lokasi_file) AS lokasi_file
                FROM 
                    album
                LEFT JOIN 
                    foto ON album.album_id = foto.album_id
                LEFT JOIN 
                    komentarfoto ON foto.id = komentarfoto.foto_id
                LEFT JOIN 
                    `likefoto` ON foto.id = `likefoto`.`foto_id`
                WHERE
                    album.user_id = " . auth()->user()->id . "
                GROUP BY 
                    album.album_id
                ORDER BY 
                    album.created_at DESC;");

        return view('page.profil.album')->with([
            "jumlah_foto"   => DB::table('foto')
                ->where('user_id', '=', auth()->user()->id)
                ->count(),
            "jumlah_album"  => DB::table('album')
                ->where('user_id', '=', auth()->user()->id)
                ->count(),
            "album"         => $album
        ]);
    }

    public function topAlbum()
    {
        $album = DB::select("SELECT 
            album.album_id,
            album.nama_album,
            album.created_at,
            COUNT(DISTINCT `likefoto`.`id`) AS jumlah_like,
            COUNT(DISTINCT komentarfoto.id) AS jumlah_komen,
            COUNT(DISTINCT foto.id) AS jumlah_foto,
            MIN(foto.lokasi_file) AS lokasi_file
                FROM 
                    album
                LEFT JOIN 
                    foto ON album.album_id = foto.album_id
                LEFT JOIN 
                    komentarfoto ON foto.id = komentarfoto.foto_id
                LEFT JOIN 
                    `likefoto` ON foto.id = `likefoto`.`foto_id`
                WHERE
                    album.user_id = " . auth()->user()->id . "
                GROUP BY 
                    album.album_id
                ORDER BY 
                    ((COUNT(DISTINCT `likefoto`.`id`)) + (COUNT(DISTINCT komentarfoto.id))) DESC;");

        return view('page.profil.album')->with([
            "jumlah_foto"   => DB::table('foto')
                ->where('user_id', '=', auth()->user()->id)
                ->count(),
            "jumlah_album"  => DB::table('album')
                ->where('user_id', '=', auth()->user()->id)
                ->count(),
            "album"         => $album
        ]);
    }

    public function edit()
    {
        return view('page.profil.edit-profil');
    }

    public function update(Request $request, User $user)
    {
        $id = auth()->user()->id;
        $request->validate([
            'username' => 'required',
            'email' => 'required',
        ]);

        $data = $user->find($id);
        $data->nama_lengkap = $request->nama_lengkap;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->alamat = $request->alamat;
        $data->save();

        return back()->with('toast_success', 'Data Berhasil Diubah');
    }

    public function updatePassword(Request $request, User $user)
    {
        $id = auth()->user()->id;

        $request->validate([
            'password' => 'required',
        ]);

        $data = $user->find($id);
        $data->password = bcrypt($request->password);
        $data->save();

        return back()->with('toast_success', 'Password Berhasil diubah');
    }

    public function updatePic(Request $request)
    {
        $id = auth()->user()->id;
        if ($request->hasFile('foto')) {
            if ($request->fotoOld) {
                Storage::delete($request->fotoOld);
            }

            $validateData = $request->validate(['foto' => 'image']);
            $validateData['foto'] = $request->file('foto')->store('user-profil');

            // $data = $user->find($id);
            // $data->foto = $validateData['foto'];
            User::where('id', $id)
                ->update(['profile' => $validateData['foto']]);

            return back()->with('toast_success', 'Gambar berhasil diubah');
        }
        return redirect()->back();
    }


    public function detailFoto($id)
    {
        $foto = DB::table('foto')
            ->join('users', 'users.id', '=', 'foto.user_id')
            ->join('album', 'album.album_id', '=', 'foto.album_id')
            ->where('foto.id', '=', $id)
            ->select('users.username', 'users.profile', 'foto.*', 'album.nama_album')
            ->get();
        return view('page.profil.foto-detail')->with([
            "foto" => $foto,
            "x" => null
        ]);
    }


    public function detailAlbum($id)
    {
        $nama_album = DB::table('album')
            ->join('users', 'users.id', '=', 'album.user_id')
            ->where('album_id', '=', $id)
            ->select('album.*', 'users.username', 'users.profile')
            ->get();

        return view('page.profil.album-detail')->with([
            "data" => DB::table('album')
                ->where('album_id', '=', $id)
                ->get(),
            "foto_album" => DB::table('foto')
                ->where('album_id', '=', $id)
                ->orderBy('created_at', 'desc')
                ->get(),
            "nama_album" => $nama_album,
            "album_id" => $id
         ]);
    }

    public function deletePic()
    {
        $data = User::find(auth()->user()->id);
        if ($data->profile) {
            Storage::delete($data->profile);
        }
        $data->profile = null;
        $data->save();

        return redirect()->back()->with('toast_success', 'Foto profil berhasi dihapus');
    }

}
