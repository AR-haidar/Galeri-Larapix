@extends('layouts.profil')
@section('profil')
    <div class="w-100">
        <div class="d-flex justify-content-end pe-5 py-2">
            <div class="dropdown me-5">
                <button class="btn btn-sm btn-warning fw-bold dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Urutkan
                </button>
                <ul class="dropdown-menu shadow">
                    <li><a class="dropdown-item fs-6 {{ Request::is('profil/album') ? 'bg-opacity-10 bg-black' : '' }}"
                            href="{{ route('profil-album') }}">Terbaru</a></li>
                    <li><a class="dropdown-item fs-6 {{ Request::is('profil/album/topAlbum') ? 'bg-opacity-10 bg-black' : '' }}"
                            href="{{ route('profil-topAlbum') }}">Like & komentar terbanyak</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12 ps-5">
                <div class="row gap-3 d-flex ps-5">
                    @forelse ($album as $item)
                        <a href="{{ url('/album/' . $item->album_id) }}"
                            class="col-4 album p-0 rounded rounded-2 text-decoration-none text-white"
                            style="
                            @if ($item->lokasi_file) background-image: url('{{ asset('storage/' . $item->lokasi_file) }}');
                            
                            @else
                            background-image: url('{{ asset('empty.svg') }}'); 
                            background-size: 40%; @endif
                            ">
                            <div class="fs-6 d-flex gradient align-items-end w-100 h-100 p-3 rounded rounded-2">
                                <div class="d-block">
                                    <div class="fs-4 fw-bold">
                                        {{ $item->nama_album }} <span class="fw-normal fs-6">({{ $item->jumlah_foto }}
                                            Foto)</span> 
                                    </div>
                                    <div class="info-album fs-6">
                                        <div class=" fw-normal">
                                            Dibuat pada {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                                        </div>
                                        <div class="">
                                            <div>{{ $item->jumlah_like }} Like</div>
                                            <div>{{ $item->jumlah_komen }} Komentar</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <center>
                            <div class="d-flex justify-content-center align-items-center bg-light col-4"
                                style=" width: 320px; height: 320px; color:#b1b5b9;">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                        fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                                        <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
                                        <path
                                            d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z" />
                                    </svg>
                                    <h6 class="mt-3">Belum Ada Album</h6>
                                </div>
                            </div>
                        </center>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
