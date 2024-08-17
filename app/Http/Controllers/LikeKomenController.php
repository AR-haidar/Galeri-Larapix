<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Komentar;

class LikeKomenController extends Controller
{
    public function like($foto_id, $user_id)
    {
        // $foto_id = $request->foto_id;
        // $user_id = auth()->user()->id;

        Like::create([
            "foto_id" => $foto_id,
            "user_id" => $user_id
        ]);
        // return back();
    }

    public function unlike($like_id)
    {
        // $like_id = $request->like_id;
        $data = Like::find($like_id);
        $data->delete();

        // return back();
    }

    public function like2(Request $request)
    {
        $foto_id = $request->foto_id;
        $user_id = auth()->user()->id;

        Like::create([
            "foto_id" => $foto_id,
            "user_id" => $user_id
        ]);
        return back();
    }

    public function unlike2(Request $request)
    {
        $like_id = $request->like_id;
        $data = Like::find($like_id);
        $data->delete();

        return back();
    }


    public function komen(Request $request, $id)
    {
        $foto_id = $id;
        $isi_komentar = $request->isi_komentar;
        $user_id = auth()->user()->id;

        Komentar::create([
            "foto_id" => $foto_id,
            "isi_komentar" => $isi_komentar,
            "user_id" => $user_id,
            "parent" => 0
        ]);
    }

    public function komen2(Request $request)
    {
        $foto_id = $request->id_foto;
        $isi_komentar = $request->isi_komentar;
        $user_id = auth()->user()->id;

        Komentar::create([
            "foto_id" => $foto_id,
            "isi_komentar" => $isi_komentar,
            "user_id" => $user_id,
            "parent" => 0
        ]);

        return back();
    }

    public function deleteKomen($komen_id)
    {
        $id = $komen_id;
        $data = Komentar::find($id);
        $data->delete();
    }

    public function deleteKomen2(Request $request)
    {
        $id = $request->komen_id;
        $data = Komentar::find($id);
        $data->delete();

        return back();
    }
}
