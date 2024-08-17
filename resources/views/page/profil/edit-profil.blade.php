@extends('layouts.main')

@section('container')
    <div class="header ps-4 pt-4">
        <a href="{{ route('profil') }}">
            <svg class="bg-dark rounded rounded-circle" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                viewBox="0 0 24 24" style="fill: #FFCA2C; transform: ;msFilter:;">
                <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm5 11h-5v4l-5-5 5-5v4h5v2z">
                </path>
            </svg>
        </a>
        <h1 class="h3 mt-2">Edit Profil</h1>
    </div>
    <div class="body px-4">
        <div class="row">
            <div class="col-12">
                @if (auth()->user()->profile)
                    <img class="rounded rounded-circle border border-5"
                        src="{{ asset('storage/' . auth()->user()->profile) }}" alt=""
                        style="width: 140px; height: 140px;">
                @else
                    <img class="rounded rounded-circle border border-5" src="{{ asset('profil.jpg') }}" alt=""
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
                <!-- Modal -->
                <div class="modal fade" id="editprofil" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
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
                                                    <img class="img-preview w-50" id="output-image"
                                                        src="{{ asset('storage/' . auth()->user()->profile) }}">
                                                @else
                                                    <img class="img-preview w-50" id="output-image"
                                                        src="{{ asset('profil.jpg') }}">
                                                @endif
                                            </div>

                                            <input class="mt-2 form-control w-100" type="file" name="foto"
                                                id="" accept="image/*" required id="image"
                                                onchange="previewImage(this)" required>
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

            <div class="col-6">

                <form action="{{ route('update-profil') }}" method="post">
                    @csrf
                    <table>
                        <tr>
                            <td class="pe-5 pt-2 fw-bold">
                                Ubah Profil
                            </td>
                            <td class="ps-2 pt-2">

                            </td>
                        </tr>
                        <tr>
                            <td class="pe-5 pt-2">
                                Nama Lengkap
                            </td>
                            <td class="ps-2 pt-2">
                                <input type="text" autocomplete="off" class="form-control"
                                    value="{{ auth()->user()->nama_lengkap }}" name="nama_lengkap">
                            </td>
                        </tr>
                        <tr>
                            <td class="pe-5 pt-2">
                                Username
                            </td>
                            <td class="ps-2 pt-2">
                                <input type="text" autocomplete="off" class="form-control"
                                    value="{{ auth()->user()->username }}" required name="username">
                            </td>
                        </tr>
                        <tr>
                            <td class="pe-5 pt-2">
                                Email
                            </td>
                            <td class="ps-2 pt-2">
                                <input type="text" autocomplete="off" class="form-control"
                                    value="{{ auth()->user()->email }}" required name="email">
                            </td>
                        </tr>
                        <tr>
                            <td class="pe-5 pt-2">
                                Alamat
                            </td>
                            <td class="ps-2 pt-2">
                                <textarea class="form-control" name="alamat">{{ auth()->user()->alamat }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="pe-5 pt-2">

                            </td>
                            <td class="ps-2 pt-2 text-end">
                                <button class="btn btn-warning fw-bold" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                        <path
                                            d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>

            <div class="col-6">
                <form action="{{ route('update-password') }}" method="post">
                    @csrf
                    <table>
                        <tr>
                            <td class="pe-5 pt-2 fw-bold">
                                Ubah Password
                            </td>
                            <td class="ps-2 pt-2">

                            </td>
                        </tr>
                        <tr>
                            <td class="pe-5 pt-2">
                                Password
                            </td>
                            <td class="ps-2 pt-2">
                                <input type="password" class="form-control" required name="password">
                            </td>
                        </tr>
                        <tr>
                            <td class="pe-5 pt-2">

                            </td>
                            <td class="ps-2 pt-2 text-end">
                                <button class="btn btn-warning fw-bold" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                        <path
                                            d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>

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
