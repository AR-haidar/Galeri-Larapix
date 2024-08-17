@extends('layouts.main')

@section('container')
    <div class="ps-4 pt-3">
        <button class="btn rounded-circle p-0" onclick="goBack()">
            <svg class="bg-dark rounded rounded-circle" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                viewBox="0 0 24 24" style="fill: #FFCA2C; transform: ;msFilter:;">
                <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm5 11h-5v4l-5-5 5-5v4h5v2z">
                </path>
            </svg>
        </button>
    </div>
    <div class="ms-4 mt-3">
        @foreach ($nama_album as $item)
            <div class="d-flex justify-content-between">
                <h4 class="fw-normal">
                    <span class="fw-bold h4">{{ $item->nama_album }}</span>
                </h4>

                @if ($item->user_id == auth()->user()->id)
                    {{-- icon settings --}}
                    <button type="button" class="btn btn-sm border-0" data-bs-toggle="modal" data-bs-target="#setting">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgb(0, 0, 0);transform: ;msFilter:;">
                            <path
                                d="M12 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm6 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM6 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z">
                            </path>
                        </svg>
                    </button>

                    <div class="modal fade" style="padding-top: 200px;" id="setting" tabindex="-1"
                        aria-labelledby="setting" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content shadow-lg">
                                <form action="{{ url('/deleteAlbum/' . $item->album_id) }}" method="post">
                                    <div class="modal-footer flex-nowrap p-0">

                                        @csrf
                                        <button onclick="return confirm ('Hapus album ini?')" type="submit"
                                            class="btn btn-lg btn-light fs-6 text-decoration-none col-12 m-0 text-danger fw-bold">
                                            Hapus Album
                                        </button>

                                    </div>
                                </form>
                                <div class="modal-footer flex-nowrap p-0">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#editalbum"
                                        class="btn btn-lg btn-light fs-6 text-decoration-none col-12 m-0 ">
                                        Edit Album
                                    </button>
                                </div>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <div class="modal-footer flex-nowrap p-0">

                                        <button data-bs-toggle="modal" data-bs-target="#unggahfoto" type="button"
                                            class="btn btn-lg btn-light fs-6 text-decoration-none col-12 m-0 ">
                                            Tambah Foto ke album
                                        </button>

                                    </div>
                                </form>
                                <div class="modal-footer flex-nowrap p-0">
                                    <button type="button"
                                        class="btn btn-lg btn-light fs-6 text-decoration-none col-12 m-0 "
                                        data-bs-dismiss="modal">
                                        Batal
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="editalbum" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div
                                    class="header border-bottom p-2 pb-0 d-flex justify-content-between align-content-center">
                                    <button type="button" class=" border-0 p-0 bg-white" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                            viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                            <path
                                                d="M12.707 17.293 8.414 13H18v-2H8.414l4.293-4.293-1.414-1.414L4.586 12l6.707 6.707z">
                                            </path>
                                        </svg>
                                    </button>
                                    <h5 class="fs-6 fw-bold mt-2">Edit Info Album</h5>
                                    <span></span>
                                </div>

                                <form action="{{ url('/editAlbum/' . $item->id) }}" method="post">
                                    @csrf
                                    <div class="modal-body">

                                        <div class="row">
                                            <div class="col-12">

                                                <div class="d-flex align-items-center">
                                                    @if (auth()->user()->profile)
                                                        <img class="rounded rounded-circle"
                                                            src="{{ asset('storage/' . auth()->user()->profile) }}"
                                                            alt="" style="width: 2rem; height: 2rem;">
                                                    @else
                                                        <img class="rounded rounded-circle" src="{{ asset('profil.jpg ') }}"
                                                            alt="" style="width: 2rem; height: 2rem;">
                                                    @endif
                                                    <div class="pt-2">
                                                        <h5 class="fs-6 ms-4" style="">
                                                            {{ auth()->user()->username }}</h5>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <input
                                                        class="mt-2 w-100 border-0 border-bottom border-2 fw-bolder placeholder-input"
                                                        type="text" name="nama_album" style="outline: none;"
                                                        placeholder="Tulis nama album" required
                                                        value="{{ $item->nama_album }}">
                                                    <textarea class="mt-2 w-100 border-0 border-bottom border-2" name="deskripsi_album" id=""
                                                        style="height: 270px; outline: none;" placeholder="Tulis deskripsi album">{{ $item->deskripsi_album }}</textarea>
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
                @endif


            </div>
            <div class="d-flex">
                <p class="mb-1">
                    {{ $item->deskripsi_album }}
                </p>
            </div>
            <div class="d-flex align-items-center justify-content-between ">
                <div class="d-flex align-items-center">
                    <h6 class="fs-6 text-muted mb-0">
                        Dibuat oleh : &nbsp;
                    </h6>
                    @if ($item->profile)
                        <img class="rounded-circle border" src="{{ asset('storage/' . $item->profile) }}" alt=""
                            style="width: 1.6rem; height: 1.6rem;">
                    @else
                        <img class="rounded-circle border" src="{{ asset('profil.jpg') }}" alt=""
                            style="width: 1.6rem">
                    @endif
                    <a href="{{ url('profil/' . $item->id) }}"
                        class="text-decoration-none text-dark fs-6 mb-0 ms-2">{{ $item->username }}</a>
                </div>
                <div class="text-muted">
                    {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                </div>
            </div>
        @endforeach

    </div>
    <div class="body ps-5 pt-3">
        <div class="row gap-2">
            @foreach ($nama_album as $x)
                @if ($x->user_id == auth()->user()->id)
                    <!-- Button trigger modal -->
                    <button type="button" class="rounded rounded-2 border border-2 bg-light col-4"
                        data-bs-toggle="modal" data-bs-target="#unggahfoto"
                        style=" width: 320px; height: 320px; color:#b1b5b9;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 24 24"
                            style="fill: #b1b5b9;transform: ;msFilter:;">
                            <path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4z"></path>
                            <path
                                d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z">
                            </path>
                        </svg>
                        <h6 class="mt-2">Unggah foto ke album ini</h6>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="unggahfoto" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div
                                    class="header border-bottom p-2 pb-0 d-flex justify-content-between align-content-center">
                                    <button type="button" class=" border-0 p-0 bg-white" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                            viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                            <path
                                                d="M12.707 17.293 8.414 13H18v-2H8.414l4.293-4.293-1.414-1.414L4.586 12l6.707 6.707z">
                                            </path>
                                        </svg>
                                    </button>
                                    <h5 class="fs-6 fw-bold">Unggah Foto</h5>
                                    <span></span>
                                </div>

                                <form action="{{ route('insert-foto') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">

                                        <div class="row">
                                            <input type="hidden" name="album_id" id=""
                                                value="{{ $album_id }}">
                                            <div class="col-6 p-2">
                                                <img class="img-preview img-fluid w-100" id="output-image">
                                                <input class="mt-2 form-control w-100" type="file" name="foto"
                                                    id="" accept="image/*" required id="image"
                                                    onchange="previewImage(this)">
                                            </div>
                                            <div class="col-6">

                                                <div class="d-flex align-items-center">
                                                    @if (auth()->user()->profile)
                                                        <img class="rounded rounded-circle"
                                                            src="{{ asset('storage/' . auth()->user()->profile) }}"
                                                            alt="" style="width: 2rem; height: 2rem;">
                                                    @else
                                                        <img class="rounded rounded-circle"
                                                            src="{{ asset('profil.jpg') }}" alt=""
                                                            style="width: 2rem; height: 2rem;">
                                                    @endif
                                                    <div class="pt-2">
                                                        <h5 class="fs-6 ms-4" style="">
                                                            {{ auth()->user()->username }}</h5>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <input
                                                        class="mt-2 w-100 border-0 border-bottom border-2 fw-bolder placeholder-input"
                                                        type="text" name="judul_foto" style="outline: none;"
                                                        placeholder="Tulis judul foto" required autocomplete="off">
                                                    <textarea class="mt-2 w-100 border-0 border-bottom border-2" name="deskripsi_foto" id=""
                                                        style="height: 270px; outline: none;" placeholder="Tulis Deskripsi Foto"></textarea>
                                                </div>
                                                <div class="d-flex justify-content-end mt-2">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-warning fw-bold">Unggah</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            @forelse ($foto_album as $item)
                <a href="{{ url('/foto/' . $item->id) }}" class="col-4 rounded rounded-2 foto border border-2"
                    style="background-image: url('{{ asset('storage/' . $item->lokasi_file) }}'); ">
                </a>
            @empty
            @endforelse


        </div>
    </div>


    <script>
        //Preview Image 
        function previewImage(image) {
            var img = image.files[0];
            var reader = new FileReader();
            reader.onloadend = function() {
                $("#output-image").attr("src", reader.result);
            }
            reader.readAsDataURL(img);
        }
    </script>
@endsection