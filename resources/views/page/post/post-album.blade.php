@extends('layouts.main')

@section('container')
    <div class="header ps-4 pt-4">
        {{-- <a href="{{ route('profil') }}">
            <svg class="bg-dark rounded rounded-circle" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                viewBox="0 0 24 24" style="fill: #FFCA2C; transform: ;msFilter:;">
                <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm5 11h-5v4l-5-5 5-5v4h5v2z">
                </path>
            </svg>
        </a> --}}
        <h1 class="h3 mt-2">Buat Album</h1>
    </div>
    <div class="body ps-4 mb-4">
        <div class="row mt-3">

            <div class="col-3 h-100">
                <form action="{{ route('insert-album') }}" method="post">
                    @csrf
                    <div class="">
                        <label class="form-label" for="nama_album">Nama Album</label>
                        <input class="form-control" type="text" name="nama_album" id="nama_album"
                            placeholder="Tulis nama album" required autocomplete="off">
                    </div>

                    <button type="button" class="btn btn-sm button-secondary w-100 mt-2 fw-bold py-2"
                        data-bs-toggle="modal" data-bs-target="#unggahfoto">
                        Unggah Foto
                    </button>

                    <div class="mt-2">
                        <label class="form-label" for="deskripsi_album">Deskripsi Album</label>
                        <textarea class="form-control" type="text" name="deskripsi_album" id="deskripsi_album"
                            placeholder="Tulis deskripsi album" style="height: 200px" autocomplete="off"></textarea>
                    </div>

                    <button type="submit" class="btn btn-sm btn-warning w-100 mt-2 fw-bold py-2" id="buttonA">
                        Buat Album
                    </button>

                </form>
            </div>

            {{-- Modal Unggah --}}
            <div class="modal fade" id="unggahfoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="header border-bottom p-2 pb-0 d-flex justify-content-between align-content-center">
                            <button type="button" class=" border-0 p-0 bg-white" data-bs-dismiss="modal"
                                aria-label="Close">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
                                    style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                    <path
                                        d="M12.707 17.293 8.414 13H18v-2H8.414l4.293-4.293-1.414-1.414L4.586 12l6.707 6.707z">
                                    </path>
                                </svg>
                            </button>
                            <h5 class="fs-6 fw-bold">Unggah Foto</h5>
                            <span></span>
                        </div>

                        <form action="{{ route('to-keranjang') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-6 p-2 h-100">
                                        <img class="img-preview img-fluid w-100 h-100" id="output-image">
                                        <input class="mt-2 form-control w-100" type="file" name="foto"
                                            accept="image/*" required id="image" onchange="previewImage(this)" />
                                    </div>
                                    <div class="col-6">

                                        <div class="d-flex align-items-center">
                                            @if (auth()->user()->profile)
                                                <img class="rounded rounded-circle"
                                                    src="{{ asset('storage/' . auth()->user()->profile) }}" alt=""
                                                    style="width: 2rem; height: 2rem;">
                                            @else
                                                <img class="rounded rounded-circle" src="{{ asset('profil.jpg ') }}"
                                                    alt="" style="width: 2rem; height: 2rem;">
                                            @endif
                                            <div class="pt-2">
                                                <h5 class="fs-6 ms-4" style="">{{ auth()->user()->username }}</h5>
                                            </div>
                                        </div>
                                        <div class="">
                                            <input
                                                class="mt-2 w-100 border-0 border-bottom border-2 fw-bolder placeholder-input"
                                                type="text" name="judul_foto" style="outline: none;"
                                                placeholder="Tulis judul foto" required>
                                            <textarea class="mt-2 w-100 border-0 border-bottom border-2" name="deskripsi_foto" id=""
                                                style="height: 270px; outline: none;" placeholder="Tulis Deskripsi Foto"></textarea>
                                        </div>
                                        <div class="d-flex justify-content-end mt-2">
                                            <button type="submit" class="btn btn-sm btn-warning fw-bold">Unggah</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-9 pe-0 border-start">
                <div class="ms-2 row gap-3">

                    @forelse ($keranjang as $item)
                        <div class="col-5 p-3 border border-1">
                            <div class="">
                                <img class="w-100" src="{{ asset('storage/' . $item->foto) }}" alt=""
                                    style="max-height: 400px">
                            </div>
                            <div class="mt-2">

                                <div class="d-flex justify-content-between align-items-center ">

                                    <h6 class="fs-5 w-100 fw-bold" type="text" style="margin-bottom: -3px;">
                                        {{ $item->judul_foto }}</h6>
                                    <form action="{{ url('/hapusKeranjang/' . $item->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-sm float-end"
                                            onclick="return confirm('hapus?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" style="fill: #dc3545; transform: ;msFilter:;">
                                                <path
                                                    d="M5 20a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8h2V6h-4V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H3v2h2zM9 4h6v2H9zM8 8h9v12H7V8z">
                                                </path>
                                                <path d="M9 10h2v8H9zm4 0h2v8h-2z"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>

                                <h6 class="fs-6 w-100 fw-lighter mt-1">{{ $item->deskripsi_foto }}</h5>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 d-flex justify-content-center align-content-center">

                        </div>
                    @endforelse
                </div>
            </div>
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
