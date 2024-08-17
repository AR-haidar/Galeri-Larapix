@extends('layouts.main')

@section('container')
    <div class="header ms-4 pt-4">
        <h1 class="h3 mt-2">Unggah Foto</h1>
    </div>
    <div class="body ms-4 mb-4">

        <div class="w-100 d-flex justify-content-center align-items-center border-2 border p-2 bg-white fw-bold">
            Pilih Album
        </div>

        <div class="w-100 mt-2">
            <div class="row">
                <div class="col-12 ps-4">
                    <div class="row gap-3 d-flex">
                        @forelse ($album as $item)
                            <a href="{{ url('/album/' . $item->album_id) }}"
                                class="col-4 album p-0 rounded rounded-2 text-decoration-none text-white"
                                style="background-image: url('{{ asset('storage/' . $item->lokasi_file) }}'); ">
                                <div class="h5 d-flex gradient align-items-end w-100 h-100 p-3 rounded rounded-2">
                                    {{ $item->nama_album }}
                                </div>
                            </a>
                        @empty

                            <div class="d-flex justify-content-center align-items-center bg-light col-4"
                                style=" width: 320px; height: 320px; color:#b1b5b9;">
                                <div class="">
                                    <center>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                            fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                                            <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
                                            <path
                                                d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z" />
                                        </svg>
                                    </center>
                                    <h6 class="mt-3">Belum Ada Album</h6>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
