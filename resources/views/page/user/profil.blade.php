@extends('layouts.main')

@section('container')
    @foreach ($user as $item)
        <div class="h-100">
            <div class="row">

                <div class="col-4 d-flex justify-content-center align-items-center">
                    @if ($item->profile)
                        <img class="rounded rounded-circle border-5 border" src="{{ asset('storage/' . $item->profile) }}"
                            alt="" style="width: 140px; height: 140px;">
                    @else
                        <img class="rounded rounded-circle border-5 border" src="{{ asset('profil.jpg') }}" alt=""
                            style="width: 140px; height: 140px;">
                    @endif

                </div>

                <div class="col-8 pt-5 pb-3 d-block">

                    <div class="d-flex w-50 justify-content-between align-items-center">
                        <div class="fs-6 me-5" style="font-weight: 500;">{{ $item->username }}</div>
                    </div>

                    <div class="mt-4 d-flex justify-content-around w-50">
                        <div class="">
                            <a href="{{ url('profil/' . $item->id) }}"
                                class="d-flex align-items-center  w-50 text-decoration-none text-dark ">
                                <h5 class="fs-5 fw-bold text-center ">
                                    {{ $jumlah_foto }}
                                </h5>
                                <h5 class="fs-6 text-center ms-1" style="font-weight: 400">Foto</h5>
                            </a>
                        </div>
                        <div class="">
                            <a href="{{ url('profil/' . $item->id . '/album') }}"
                                class="d-flex align-items-center  w-50 text-decoration-none text-dark ">
                                <h5 class="fs-5 fw-bold text-center ">
                                    {{ $jumlah_album }}
                                </h5>
                                <h5 class="fs-6 text-center ms-1" style="font-weight: 400">Album</h5>
                            </a>
                        </div>
                    </div>

                    <div class="mt-4 mb-2">
                        <h5 class="fs-6 fw-bold">{{ $item->nama_lengkap }}</h5>
                    </div>

                    <div class="">
                        <h5 class="fs-6 fw-light">{{ $item->alamat }}</h5>
                    </div>

                </div>

            </div>

            <div id="=" class="border-top border-bottom border-2 d-flex justify-content-center align-items-center">
                <div class="w-50 d-flex justify-content-around align-items-center">
                    <div class="{{ Request::is('profil/' . $item->id) ? 'border-top border-2 border-dark ' : '' }} p-2">
                        <a class="d-flex align-items-center text-decoration-none fs-6   {{ Request::is('profil/'. $item->id) ? 'text-dark fw-bold ' : 'text-muted ' }}"
                            href="{{ url('profil/' . $item->id) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-image" viewBox="0 0 16 16">
                                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                <path
                                    d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z" />
                            </svg>
                            <div class="ms-2">Foto</div>
                        </a>
                    </div>

                    <div
                        class="{{ Request::is('profil/' . $item->id . '/album') ? 'border-top border-2 border-dark ' : '' }} p-2 ms-5">
                        <a href="{{ url('profil/' . $item->id . '/album') }}"
                            class="d-flex align-items-center text-decoration-none fs-6 {{ Request::is('profil/' . $item->id . '/album') ? 'text-dark fw-bold ' : 'text-muted ' }}"
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
                @yield('user')
            </div>
        </div>
    @endforeach

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
