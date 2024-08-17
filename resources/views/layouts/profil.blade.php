@extends('layouts.main')

@section('container')
    <div class="h-100">
        <div class="row">

            <div class="col-4 d-flex justify-content-center align-items-center">
                @if (auth()->user()->profile)
                    <img class="rounded rounded-circle border-5 border"
                        src="{{ asset('storage/' . auth()->user()->profile) }}" alt=""
                        style="width: 140px; height: 140px; object-fit: cover">
                @else
                    <img class="rounded rounded-circle border-5 border" src="{{ asset('profil.jpg') }}" alt=""
                        style="width: 140px; height: 140px;">
                @endif

                <button type="button" class="change-profile btn btn-warning rounded-circle border border-3 border-light"
                    data-bs-toggle="modal" data-bs-target="#editprofil">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-camera-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                        <path
                            d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0" />
                    </svg>
                </button>

                <!-- Modal PP-->
                <div class="modal fade" id="editprofil" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="header p-4 pb-0 d-flex justify-content-center align-content-center">
                                <h5 class="fs-6 fw-bold">Ubah Foto Profil</h5>
                            </div>

                            <form action="{{ route('update-pic') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-12 p-2">
                                            <input type="hidden" name="fotoOld" value="{{ auth()->user()->profile }}">
                                            <div class="w-100 d-flex justify-content-center">
                                                @if (auth()->user()->profile)
                                                    <img id="output-image" class="img-preview w-50"
                                                        src="{{ asset('storage/' . auth()->user()->profile) }}">
                                                @else
                                                    <img id="output-image" class="img-preview w-50"
                                                        src="{{ asset('profil.jpg') }}">
                                                @endif
                                            </div>

                                            <input class="mt-2 form-control w-100" type="file" name="foto"
                                                id="" required id="image" onchange="previewImage(this)"
                                                accept="image/*" required>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer flex-nowrap p-0">

                                    <button type="submit"
                                        class="btn btn-lg btn-light text-primary fw-bold fs-6 text-decoration-none col-12 m-0 ">
                                        Ubah Foto
                                    </button>
                                </div>
                            </form>

                            <form action="{{ route('delete-pic') }}" method="post">
                                @csrf
                                <div class="modal-footer flex-nowrap p-0">

                                    <button onclick="return confirm ('Hapus foto saat ini?')" type="submit"
                                        class="btn btn-lg btn-light text-danger fs-6 fw-bold text-decoration-none col-12 m-0 ">
                                        Hapus Foto Saat Ini
                                    </button>

                                </div>
                            </form>

                            <div class="modal-footer flex-nowrap p-0">

                                <button type="button" class="btn btn-lg btn-light fs-6 text-decoration-none col-12 m-0 "
                                    data-bs-dismiss="modal">
                                    Batal
                                </button>

                            </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-8 pt-5 pb-3 d-block">

                <div class="d-flex w-50 justify-content-between align-items-center">
                    <div class="fs-6 me-5" style="font-weight: 500;">{{ auth()->user()->username }}</div>
                    <div class="d-flex">

                        <a href="{{ route('edit-profil') }}" class="btn btn-sm button-secondary ms-5 me-2 px-3 fw-bold">Edit
                            profil</a>

                        {{-- icon settings --}}
                        <button type="button" class="btn btn-sm border-0" data-bs-toggle="modal" data-bs-target="#setting">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-gear-fill" viewBox="0 0 16 16">
                                <path
                                    d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                            </svg>
                        </button>

                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="setting" tabindex="-1" aria-labelledby="setting" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content shadow-lg">
                                {{-- <div class="modal-footer flex-nowrap p-0">

                                    <button onclick="return confirm ('Hapus akun ini?')" type="submit"
                                        class="btn btn-lg btn-light fs-6 text-decoration-none col-12 m-0 ">
                                        Hapus Akun
                                    </button>

                                </div> --}}
                                <div class="modal-footer flex-nowrap p-0 d-block border-bottom py-3">
                                    <div class="d-flex justify-content-center ">
                                        @if (auth()->user()->profile)
                                            <img class="rounded rounded-circle border-5 border"
                                                src="{{ asset('storage/' . auth()->user()->profile) }}" alt=""
                                                style="width: 140px; height: 140px; object-fit: cover">
                                        @else
                                            <img class="rounded rounded-circle border-5 border"
                                                src="{{ asset('profil.jpg') }}" alt=""
                                                style="width: 140px; height: 140px;">
                                        @endif
                                    </div>
                                    <div class="text-center text-muted my-1">
                                        Dibuat pada
                                        <span class="fw-bold ">
                                            {{ \Carbon\Carbon::parse(auth()->user()->created_at)->format('d/m/Y') }}
                                        </span>
                                    </div>
                                </div>

                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <div class="modal-footer flex-nowrap p-0">

                                        <button onclick="return confirm ('Ingin keluar?')" type="submit"
                                            class="btn btn-lg btn-light fs-6 text-decoration-none col-12 m-0 ">
                                            Logout
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

                </div>

                <div class="mt-4 d-flex justify-content-around w-50">
                    <div class="">
                        <a href="{{ url('profil/foto') }}"
                            class="d-flex align-items-center  w-50 text-decoration-none text-dark ">
                            <h5 class="fs-5 fw-bold text-center ">
                                {{ $jumlah_foto }}
                            </h5>
                            <h5 class="fs-6 text-center ms-1" style="font-weight: 400">Foto</h5>
                        </a>
                    </div>
                    <div class="">
                        <a href="{{ url('profil/album') }}"
                            class="d-flex align-items-center  w-50 text-decoration-none text-dark ">
                            <h5 class="fs-5 fw-bold text-center ">
                                {{ $jumlah_album }}
                            </h5>
                            <h5 class="fs-6 text-center ms-1" style="font-weight: 400">Album</h5>
                        </a>
                    </div>
                </div>

                <div class="mt-4 mb-2">
                    <h5 class="fs-6 fw-bold">{{ auth()->user()->nama_lengkap }}</h5>
                </div>

                <div class="">
                    <h5 class="fs-6 fw-light">{{ auth()->user()->alamat }}</h5>
                </div>
            </div>

        </div>

        <div id="=" class="border-top border-bottom border-2 d-flex justify-content-center align-items-center">
            <div class="w-50 d-flex justify-content-around align-items-center">
                <div class="{{ Request::is('profil/foto*') ? 'border-top border-2 border-dark ' : '' }} p-2">
                    <a class="d-flex align-items-center text-decoration-none fs-6   {{ Request::is('profil/foto*') ? 'text-dark fw-bold ' : 'text-muted ' }}"
                        href="{{ route('profil') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-image" viewBox="0 0 16 16">
                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                            <path
                                d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z" />
                        </svg>
                        <div class="ms-2">Foto</div>
                    </a>
                </div>

                <div class="{{ Request::is('profil/album*') ? 'border-top border-2 border-dark ' : '' }} p-2 ms-5">
                    <a href="{{ route('profil-album') }}"
                        class="d-flex align-items-center text-decoration-none fs-6 {{ Request::is('profil/album*') ? 'text-dark fw-bold ' : 'text-muted ' }}"
                        href="{{ route('profil-album') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-image" viewBox="0 0 16 16">
                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                            <path
                                d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z" />
                        </svg>
                        <div class="ms-2">Album</div>
                    </a>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            @yield('profil')
        </div>
    </div>

    <script>
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
