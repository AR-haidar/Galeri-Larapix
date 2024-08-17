<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

use App\Models\Keranjang;
use App\Models\Foto;
use App\Models\Album;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public function index()
    {
        return view('page.post.post-album')->with([
            "keranjang" => DB::table('keranjang')
                ->where('user_id', '=', auth()->user()->id)
                ->get()
        ]);
    }

    public function index2(Request $request)
    {
        $request->session()->forget('sesAlbum');

        $keranjang = DB::table('keranjang')
            ->where('user_id', '=', auth()->user()->id)
            ->get();

        $album =  DB::table('album')
            ->leftJoin('foto', 'foto.album_id', '=', 'album.album_id')
            ->groupBy('album.album_id')
            ->where('album.user_id', '=', auth()->user()->id)
            ->select('album.id', 'album.album_id', 'foto.lokasi_file', 'album.nama_album')
            ->get();

        return view('page.post.post-photo')->with([
            "keranjang" => $keranjang,
            "album" => $album
        ]);
    }

    public function albumInsert(Request $request)
    {
        $request->validate([
            "nama_album" => "required"
        ]);

        $albumId = Carbon::now()->setTimezone('Asia/Jakarta')->format('YmdHis');
        $now =  Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
        $user = auth()->user()->id;

        $album = new Album();
        $album->album_id = $albumId;
        $album->nama_album = $request->nama_album;
        $album->deskripsi_album = $request->deskripsi_album;
        $album->user_id = $user;
        $album->save();

        DB::statement('INSERT INTO foto (judul_foto, deskripsi_foto, lokasi_file, album_id, user_id,created_at,updated_at)
        SELECT judul_foto, deskripsi_foto,  foto,"' . $albumId . '" , user_id,"' . $now . '","' . $now . '" FROM keranjang WHERE user_id = "' . auth()->user()->id . '"');

        DB::delete('delete from keranjang where user_id = ?', ["$user"]);

        return redirect()->back()->with('toast_success', 'Berhasil membuat album');
    }

    public function fotoInsert(Request $request)
    {
        $validatedData = $request->validate([
            "foto" => "required|image|mimes:jpeg,png,jpg"
        ]);

        $validateData["foto"] = $request->file('foto')->store('post-images');

        Foto::create([
            "judul_foto" => $request->judul_foto,
            "deskripsi_foto" => $request->deskripsi_foto,
            "lokasi_file" => $validateData['foto'],
            "album_id" => $request->album_id,
            "user_id" => auth()->user()->id,
        ]);

        return redirect()->back();
    }



    public function toKeranjang(Request $request)
    {
        $validatedData = $request->validate([
            "foto" => "required|image|mimes:jpeg,png,jpg"
        ]);

        $validateData["foto"] = $request->file('foto')->store('post-images');

        Keranjang::create([
            "user_id" => auth()->user()->id,
            "foto" => $validateData['foto'],
            "judul_foto" => $request->judul_foto,
            "deskripsi_foto" => $request->deskripsi_foto
        ]);

        return redirect()->back();
    }

    public function hapusKeranjang(Keranjang $keranjang, $id)
    {
        $data = $keranjang->find($id);
        Storage::delete($data->foto);
        $data->delete();

        return redirect()->back();
    }

    public function deleteFoto(Foto $foto, $id)
    {
        $data = $foto->find($id);
        $album_id = $data->album_id;
        $data->delete();

        if ($data->lokasi_file) {
            Storage::delete($data->lokasi_file);
        }

        DB::table('likefoto')->where('foto_id', $id)->delete();
        DB::table('komentarfoto')->where('foto_id', $id)->delete();



        return redirect('/album/' . $album_id)->with('toast_success', 'Data Berhasil Dihapus');
        // return back();
    }
    public function deleteAlbum(Foto $foto, Album $album, $id)
    {

        DB::table('album')->where('album_id', '=', $id)->delete();

        $fotos = DB::table('foto')->where('album_id', '=', $id)->get();

        foreach ($fotos as $foto) {
            DB::table('foto')->where('album_id', '=', $id)->delete();
            Storage::delete($foto->lokasi_file);

            DB::table('likefoto')->where('foto_id', $foto->id)->delete();

            DB::table('komentarfoto')->where('foto_id', $foto->id)->delete();
        }


        return redirect('profil/album/')->with('toast_success', 'Data Berhasil Dihapus');
    }

    public function editFoto(Request $request, $id)
    {
        $foto = Foto::find($id);
        $foto->judul_foto = $request->judul_foto;
        $foto->album_id = $request->album_id;
        $foto->deskripsi_foto = $request->deskripsi_foto;
        $foto->save();

        return redirect()->back();
    }

    public function editAlbum(Request $request, $id)
    {
        $album = Album::find($id);
        $album->nama_album = $request->nama_album;
        $album->deskripsi_album = $request->deskripsi_album;
        $album->save();

        return redirect()->back();
    }
}
