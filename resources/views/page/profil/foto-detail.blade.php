@extends('layouts.main')

@section('container')
    {{-- <div class="ps-4 pt-3"> --}}
    {{-- </div> --}}
    <div class="d-flex align-items-start ">
        <button class="btn rounded-circle p-0 mt-2" onclick="goBack()">
            <svg class="bg-dark rounded rounded-circle" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                viewBox="0 0 24 24" style="fill: #FFCA2C; transform: ;msFilter:;">
                <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm5 11h-5v4l-5-5 5-5v4h5v2z">
                </path>
            </svg>
        </button>
        <div class="container d-flex justify-content-center">
            <div class="" style="width: 90%">
                @foreach ($foto as $item)
                    <div class="row position-relative" style="min-height: 550px">
                        <div class="col-6 p-0 h-100 border border-2 mt-2" style="max-height: 550px;">
                            <div class="body d-flex justify-content-center align-items-center" style=" min-height: 550px">
                                <img class="w-100 border-top border-bottom"
                                    src="{{ asset('storage/' . $item->lokasi_file) }}" style="max-height: 550px; ">
                            </div>
                        </div>
                        <div class="col-6 p-0 border border-2 border-start-0 mt-2 position-relative"
                            style="min-height: 100%">
                            <div class="header border-bottom p-2 ps-3 d-flex align-items-center justify-content-between">
                                <div class="d-flex">
                                    @if ($item->profile)
                                        <img src="{{ asset('storage/' . $item->profile) }}" alt=""
                                            class="rounded rounded-circle border" style="width: 2.6rem; height: 2.6rem">
                                    @else
                                        <img src="{{ asset('profil.jpg') }}" alt=""
                                            class="rounded rounded-circle border" style="width: 2.6rem; height: 2.6rem">
                                    @endif

                                    <div class="pt-2 ms-3 d-block">
                                        <a class="text-decoration-none" href="">
                                            <h5 class="fs-6 text-dark mb-0 fw-bold">{{ $item->username }}</h5>
                                        </a>
                                        <div class="text-muted fw-light">
                                            Album :
                                            <a class="text-decoration-none text-muted mt-0" href="#">
                                                {{ $item->nama_album }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    @if ($item->user_id == auth()->user()->id)
                                        <button type="button" class="btn btn-sm border-0" data-bs-toggle="modal"
                                            data-bs-target="#setting">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" style="fill: rgb(0, 0, 0);transform: ;msFilter:;">
                                                <path
                                                    d="M12 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm6 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM6 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z">
                                                </path>
                                            </svg>
                                        </button>
                                    @endif

                                    <!-- Modal -->
                                    <div class="modal fade" id="setting" tabindex="-1" aria-labelledby="setting"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                            <div class="modal-content shadow-lg">

                                                <form action="{{ url('deleteFoto/' . $item->id) }}" method="post">
                                                    @csrf
                                                    <div class="modal-footer flex-nowrap p-0">
                                                        <button onclick="return confirm ('Hapus foto ini?')" type="submit"
                                                            class="btn btn-lg btn-light fs-6 fw-bold text-danger text-decoration-none col-12 m-0 ">
                                                            Hapus Foto
                                                        </button>

                                                    </div>
                                                </form>

                                                <div class="modal-footer flex-nowrap p-0">
                                                    <button data-bs-toggle="modal" data-bs-target="#editfoto"
                                                        class="btn btn-lg btn-light fs-6 text-decoration-none col-12 m-0 ">
                                                        Edit Foto
                                                    </button>
                                                </div>

                                                <div class="modal-footer flex-nowrap p-0">
                                                    <button data-bs-dismiss="modal"
                                                        class="btn btn-lg btn-light fs-6 text-decoration-none col-12 m-0 ">
                                                        Batal
                                                    </button>
                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="editfoto" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div
                                                    class="header border-bottom p-2 pb-0 d-flex justify-content-between align-content-center">
                                                    <button type="button" class=" border-0 p-0 bg-white"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="36"
                                                            height="36" viewBox="0 0 24 24"
                                                            style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                                            <path
                                                                d="M12.707 17.293 8.414 13H18v-2H8.414l4.293-4.293-1.414-1.414L4.586 12l6.707 6.707z">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                    <h5 class="fs-6 fw-bold mt-2">Edit Info</h5>
                                                    <span></span>
                                                </div>

                                                <form action="{{ url('/editFoto/' . $item->id) }}" method="post">
                                                    @csrf
                                                    <div class="modal-body">

                                                        <div class="row">
                                                            <div class="col-6 p-2 h-100 pt-0">
                                                                <img src="{{ asset('storage/' . $item->lokasi_file) }}"
                                                                    class="img-preview img-fluid w-100 h-100"
                                                                    id="output-image">
                                                            </div>
                                                            <div class="col-6">

                                                                <div class="d-flex align-items-center">
                                                                    @if (auth()->user()->profile)
                                                                        <img class="rounded rounded-circle"
                                                                            src="{{ asset('storage/' . auth()->user()->profile) }}"
                                                                            alt=""
                                                                            style="width: 2rem; height: 2rem;">
                                                                    @else
                                                                        <img class="rounded rounded-circle"
                                                                            src="{{ asset('profil.jpg ') }}"
                                                                            alt=""
                                                                            style="width: 2rem; height: 2rem;">
                                                                    @endif
                                                                    <div class="pt-2">
                                                                        <h5 class="fs-6 ms-4" style="">
                                                                            {{ auth()->user()->username }}</h5>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="me-2">Album : </div>
                                                                    <select class="form-select w-75" name="album_id"
                                                                        id="album">
                                                                        @php
                                                                            $albums = DB::table('album')
                                                                                ->where('user_id', auth()->user()->id)
                                                                                ->get();
                                                                        @endphp
                                                                        @foreach ($albums as $album)
                                                                            <option value="{{ $album->album_id }}"
                                                                                {{ $item->album_id == $album->album_id ? 'selected' : '' }}>
                                                                                {{ $album->nama_album }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="">
                                                                    <input
                                                                        class="mt-2 w-100 border-0 border-bottom border-2 fw-bolder placeholder-input"
                                                                        type="text" name="judul_foto"
                                                                        style="outline: none;"
                                                                        placeholder="Tulis judul foto" required
                                                                        value="{{ $item->judul_foto }}">
                                                                    <textarea class="mt-2 w-100 border-0 border-bottom border-2" name="deskripsi_foto" id=""
                                                                        style="height: 270px; outline: none;" placeholder="Tulis Deskripsi Foto">{{ $item->deskripsi_foto }}</textarea>
                                                                </div>
                                                                <div class="d-flex justify-content-end mt-2">
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-warning fw-bold">Edit</button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="position-absolute w-100 scroll"
                                style="max-height: 59%; max-width: 100%; overflow-y: auto; overflow-x: hidden">
                                <div class="">
                                    <div class="caption ps-3 pt-1">
                                        <div class="judul fw-bold fs-6">
                                            {{ $item->judul_foto }}
                                        </div>
                                        <div class="caption fs-6 fw-lighter">
                                            <p>
                                                {{ $item->deskripsi_foto }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="">
                                    @php
                                        $suka = DB::table('likefoto')->where('foto_id', $item->id);
                                        $komen = DB::table('komentarfoto')
                                            ->join('users', 'users.id', '=', 'komentarfoto.user_id')
                                            ->where('foto_id', $item->id)
                                            ->orderBy('created_at', 'desc')
                                            ->select('komentarfoto.*', 'users.username', 'users.profile');
                                    @endphp
                                    <center>
                                        <div class="text-center mt-1 fw-bold w-100">
                                            {{ $komen->count() }} Komentar
                                        </div>
                                    </center>
                                    <div class="row gy-2 mt-1">
                                        @forelse ($komen->get() as $isikomen)
                                            <div class="col-12">
                                                <div class="d-flex ms-3 me-2 justify-content-between">
                                                    <div class="d-flex">
                                                        <div class="">
                                                            @if ($isikomen->profile)
                                                                <img class="rounded-circle"
                                                                    src="{{ asset('storage/' . $isikomen->profile) }}"
                                                                    alt="" style="width: 2rem; height: 2rem;">
                                                            @else
                                                                <img class="rounded-circle"
                                                                    src="{{ asset('profil.jpg') }}" alt=""
                                                                    style="width: 2rem; height: 2rem;">
                                                            @endif
                                                        </div>
                                                        <div class="ms-2">
                                                            <div class="">
                                                                <a href="{{ url('/profil/' . $item->user_id) }}"
                                                                    class="fw-bold text-decoration-none text-dark me-1">{{ $isikomen->username }}</a>
                                                                {{ $isikomen->isi_komentar }}
                                                            </div>
                                                            <div class="d-flex text-muted mt-1" style="font-size: .8rem">
                                                                <div class="fw-light">
                                                                    {{ \Carbon\Carbon::parse($isikomen->created_at)->diffForHumans() }}
                                                                </div>
                                                                {{-- <a type="button"
                                                                    class="fw-bold ms-2 text-decoration-none text-muted">Balas</a> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if ($item->user_id == auth()->user()->id)
                                                        <form action="{{ route('delete-komen2') }}" method="post">
                                                            @csrf
                                                            <div class="">
                                                                <input type="hidden" name="komen_id"
                                                                    value="{{ $isikomen->id }}">
                                                                <button onclick="return confirm('Hapus komen ini?')"
                                                                    class="border-0 text-danger text-decoration-none bg-light 
                                                                type="submit"
                                                                    style="font-size: .8rem; outline: none">
                                                                    Hapus
                                                                </button>
                                                            </div>
                                                        </form>
                                                    @elseif ($isikomen->user_id == auth()->user()->id)
                                                        <form action="{{ route('delete-komen2') }}" method="post">
                                                            @csrf
                                                            <div class="">
                                                                <input type="hidden" name="komen_id"
                                                                    value="{{ $isikomen->id }}">
                                                                <button
                                                                    class="border-0 text-danger text-decoration-none bg-light"
                                                                    type="submit"
                                                                    style="font-size: .8rem; outline: none">
                                                                    Hapus
                                                                </button>
                                                            </div>
                                                        </form>
                                                    @else
                                                    @endif
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12 d-flex justify-content-center align-items-center pt-5 fw-bold text-black-50 "
                                                style="height: 100%">
                                                Belum ada komentar
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            @php
                                $like = DB::table('likefoto')
                                    ->where('foto_id', '=', $item->id)
                                    ->where('user_id', '=', auth()->user()->id)
                                    ->get();
                            @endphp
                            <div class="footer border-top position-absolute w-100 bottom-0">
                                <div class="option d-flex align-items-center p-2">
                                    @forelse ($like as $item2)
                                        @php
                                            $x = 1;
                                        @endphp
                                        <form action="{{ route('unlike2') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="like_id" value="{{ $item2->id }}">
                                            <button class="border-0 btn p-0 me-3" type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                    viewBox="0 0 24 24"
                                                    style="fill: rgb(255, 0, 0);transform: ;msFilter:;">
                                                    <path
                                                        d="M20.205 4.791a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412L12 21.414l8.207-8.207c2.354-2.353 2.355-6.049-.002-8.416z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    @empty
                                        <form action="{{ route('like2') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="foto_id" value="{{ $item->id }}"">
                                            <button class="border-0 btn p-0 me-3" type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                    viewBox="0 0 24 24"
                                                    style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                                    <path
                                                        d="M12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412l7.332 7.332c.17.299.498.492.875.492a.99.99 0 0 0 .792-.409l7.415-7.415c2.354-2.354 2.354-6.049-.002-8.416a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595zm6.791 1.61c1.563 1.571 1.564 4.025.002 5.588L12 18.586l-6.793-6.793c-1.562-1.563-1.561-4.017-.002-5.584.76-.756 1.754-1.172 2.799-1.172s2.035.416 2.789 1.17l.5.5a.999.999 0 0 0 1.414 0l.5-.5c1.512-1.509 4.074-1.505 5.584-.002z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    @endforelse

                                    <a type="button" data-bs-toggle="modal" data-bs-target="#komen"
                                        class="border-0 btn p-0 d-flex align-items-center comment" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29"
                                            viewBox="0 0 24 24"
                                            style="fill: rgba(0, 0, 0, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);">
                                            <path
                                                d="M20 2H4c-1.103 0-2 .897-2 2v18l5.333-4H20c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2zm0 14H6.667L4 18V4h16v12z">
                                            </path>
                                        </svg>
                                    </a>

                                </div>
                                <div class="px-2">
                                    <a type="button" class="like text-decoration-none text-dark fw-bold my-1 ms-1"
                                        data-bs-toggle="modal" data-bs-target="#like{{ $item->id }}">
                                        {{ $suka->count() }}
                                        suka
                                    </a>
                                    <div class="text-muted mt-1 ms-1 pb-2" style="font-size: .9rem">
                                        {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                    </div>
                                </div>

                                <div class="modal fade" id="like{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                                        <div class="modal-content">
                                            <div
                                                class="header border-bottom p-2 pb-0 d-flex justify-content-between align-content-center">
                                                <button type="button" class=" border-0 p-0 bg-white"
                                                    data-bs-dismiss="modal" aria-label="Close">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                                        viewBox="0 0 24 24"
                                                        style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                                        <path
                                                            d="M12.707 17.293 8.414 13H18v-2H8.414l4.293-4.293-1.414-1.414L4.586 12l6.707 6.707z">
                                                        </path>
                                                    </svg>
                                                </button>
                                                <h5 class="fs-6 fw-bold mt-2">{{ $suka->count() }} suka</h5>
                                                <span></span>
                                            </div>
                                            <div class="modal-body pt-0">
                                                @php
                                                    $data_likes = DB::table('likefoto')
                                                        ->join('users', 'users.id', '=', 'likefoto.user_id')
                                                        ->select('likefoto.*', 'users.username', 'users.nama_lengkap', 'users.profile')
                                                        ->where('foto_id', '=', $item->id)
                                                        ->orderBy('likefoto.created_at', 'desc')
                                                        ->get();
                                                @endphp
                                                @forelse ($data_likes as $data_like)
                                                    <a href="{{ url('/foto/' . $data_like->user_id) }}"
                                                        class="d-flex align-items-center text-decoration-none text-dark mt-2 border-top border-bottom p-2">
                                                        <div class="me-2">
                                                            @if ($data_like->profile)
                                                                <img class="rounded rounded-circle"
                                                                    src="{{ asset('storage/' . $data_like->profile) }}"
                                                                    alt="" style="width: 2.2rem; height: 2.2rem;">
                                                            @else
                                                                <img class="rounded rounded-circle"
                                                                    src="{{ asset('profil.jpg') }}" alt=""
                                                                    style="width: 2.2rem; height: 2.2rem;">
                                                            @endif
                                                        </div>
                                                        <div class="">
                                                            <div class="fs-6 fw-bold">{{ $data_like->username }}</div>
                                                            <div class="fs-6 text-muted">{{ $data_like->nama_lengkap }}
                                                            </div>
                                                        </div>
                                                    </a>
                                                @empty
                                                    <center>
                                                        <div class="fw-bold text-muted">
                                                            kosong
                                                        </div>
                                                    </center>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('komen2') }}" method="post">
                                    @csrf
                                    <div class="ngomen border-top px-2 d-flex" id="">
                                        <input type="hidden" name="id_foto" value="{{ $item->id }}">
                                        <input class="w-100 border-0 p-2 ps-3" type="text" name="isi_komentar"
                                            placeholder="Tambahkan komentar..." style="outline: none" autocomplete="off">
                                        <button type="submit" class="border-0 bg-light px-0 py-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                viewBox="0 0 24 24" style="fill: #6C757D;transform: ;msFilter:;">
                                                <path
                                                    d="m21.426 11.095-17-8A.999.999 0 0 0 3.03 4.242L4.969 12 3.03 19.758a.998.998 0 0 0 1.396 1.147l17-8a1 1 0 0 0 0-1.81zM5.481 18.197l.839-3.357L12 12 6.32 9.16l-.839-3.357L18.651 12l-13.17 6.197z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
