@foreach ($foto as $item)
    <div class="row position-relative" style="min-height: 550px">
        <div class="col-6 p-0 h-100 border border-2 mt-2" style="max-height: 550px;">
            <div class="body d-flex justify-content-center align-items-center" style=" min-height: 550px">
                <img class="w-100 border-top border-bottom" src="{{ asset('storage/' . $item->lokasi_file) }}"
                    style="max-height: 550px; ">
            </div>
        </div>
        <div class="col-6 p-0 border border-2 border-start-0 mt-2 position-relative" style="min-height: 100%">
            <div class="header border-bottom p-2 ps-3 d-flex align-items-center">

                @if ($item->profile)
                    <img src="{{ asset('storage/' . $item->profile) }}" alt=""
                        class="rounded rounded-circle border" style="width: 2.6rem; height: 2.6rem">
                @else
                    <img src="{{ asset('profil.jpg') }}" alt="" class="rounded rounded-circle border"
                        style="width: 2.6rem; height: 2.6rem">
                @endif

                <div class="pt-2 ms-3 d-block">
                    <a class="text-decoration-none" href="{{ url('/profil/' . $item->user_id) }}">
                        <h5 class="fs-6 text-dark mb-0 fw-bold">{{ $item->username }}</h5>
                    </a>
                    <div class="text-muted fw-light">
                        Album :
                        <a class="text-decoration-none text-muted mt-0 fw-normal"
                            href="{{ url('/album/' . $item->album_id) }}">
                            {{ $item->nama_album }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="position-absolute w-100 scroll"
                style="max-height: 59%; max-width: 100%; overflow-y: auto; overflow-x: hidden">
                <div class="caption px-3 pt-1 border-bottom">
                    <div class="judul fw-bold fs-6">
                        {{ $item->judul_foto }}
                    </div>
                    <div class="caption fs-6 fw-lighter">
                        <p>
                            {{ $item->deskripsi_foto }}
                        </p>
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
                        @forelse ($komen->get() as $komens)
                            <div class="col-12">
                                <div class="d-flex ms-3 me-2 justify-content-between">
                                    <div class="d-flex">
                                        <div class="">
                                            @if ($komens->profile)
                                                <img class="rounded-circle"
                                                    src="{{ asset('storage/' . $komens->profile) }}" alt=""
                                                    style="width: 2rem; height: 2rem;">
                                            @else
                                                <img class="rounded-circle" src="{{ asset('profil.jpg') }}"
                                                    alt="" style="width: 2rem; height: 2rem;">
                                            @endif
                                        </div>
                                        <div class="ms-2">
                                            <div class="">
                                                <a href="{{ url('/profil/' . $item->user_id) }}"
                                                    class="fw-bold text-decoration-none text-dark me-1">{{ $komens->username }}</a>
                                                {{ $komens->isi_komentar }}
                                            </div>
                                            <div class="d-flex text-muted mt-1" style="font-size: .8rem">
                                                <div class="fw-light">
                                                    {{ \Carbon\Carbon::parse($komens->created_at)->diffForHumans() }}
                                                </div>
                                                {{-- <a type="button"
                                                    class="fw-bold ms-2 text-decoration-none text-muted">Balas</a> --}}
                                            </div>
                                        </div>
                                    </div>
                                    @if ($item->user_id == auth()->user()->id)
                                        <div class="">
                                            <a class="text-danger text-decoration-none" type="button"
                                                style="font-size: .8rem" onclick="deletekomen({{ $komens->id }})">
                                                Hapus
                                            </a>
                                        </div>
                                    @elseif ($komens->user_id == auth()->user()->id)
                                        <div class="">
                                            <a class="text-danger text-decoration-none" type="button"
                                                style="font-size: .8rem" onclick="deletekomen({{ $komens->id }})">
                                                Hapus
                                            </a>
                                        </div>
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
                $likes = DB::table('likefoto')
                    ->join('users', 'users.id', '=', 'likefoto.user_id')
                    ->select('likefoto.*', 'users.username', 'users.nama_lengkap')
                    ->where('foto_id', '=', $item->id)
                    ->where('user_id', '=', auth()->user()->id)
                    ->get();
            @endphp
            <div class="footer border-top position-absolute w-100 bottom-0">
                <div class="option d-flex align-items-center p-2">
                    @forelse ($likes as $like)
                        @php
                            $x = 1;
                        @endphp
                        <button class="border-0 btn p-0 me-3" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                                style="fill:  rgba(255, 0, 0,1);transform: ;msFilter:;"
                                onclick="unlike({{ $like->id }})">
                                <path
                                    d="M20.205 4.791a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412L12 21.414l8.207-8.207c2.354-2.353 2.355-6.049-.002-8.416z">
                                </path>
                            </svg>
                        </button>
                    @empty
                        <button class="border-0 btn p-0 me-3" type="submit"
                            onclick="like({{ $item->id }},{{ auth()->user()->id }})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                                style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                <path
                                    d="M12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412l7.332 7.332c.17.299.498.492.875.492a.99.99 0 0 0 .792-.409l7.415-7.415c2.354-2.354 2.354-6.049-.002-8.416a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595zm6.791 1.61c1.563 1.571 1.564 4.025.002 5.588L12 18.586l-6.793-6.793c-1.562-1.563-1.561-4.017-.002-5.584.76-.756 1.754-1.172 2.799-1.172s2.035.416 2.789 1.17l.5.5a.999.999 0 0 0 1.414 0l.5-.5c1.512-1.509 4.074-1.505 5.584-.002z">
                                </path>
                            </svg>
                        </button>
                    @endforelse

                    <a type="button" onclick="slidekomen({{ $item->id }})"
                        class="border-0 btn p-0 d-flex align-items-center comment">
                        <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 24 24"
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
                                <button type="button" class=" border-0 p-0 bg-white" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                        viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
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
                                                <img class="rounded rounded-circle" src="{{ asset('profil.jpg') }}"
                                                    alt="" style="width: 2.2rem; height: 2.2rem;">
                                            @endif
                                        </div>
                                        <div class="">
                                            <div class="fs-6 fw-bold">{{ $data_like->username }}</div>
                                            <div class="fs-6 text-muted">{{ $data_like->nama_lengkap }}</div>
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

                <div class="" style="display: none" id="input-komen{{ $item->id }}">
                    <div class="ngomen border-top px-2 d-flex" id="">
                        <input class="w-100 border-0 p-2 ps-3" type="text" id="isi_komentar{{ $item->id }}"
                            name="isi_komentar" placeholder="Tambahkan komentar..." autocomplete="off"
                            style="outline: none" required>
                        <button class="border-0 bg-light px-0 py-1" type="submit"
                            onclick="komen({{ $item->id }})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                viewBox="0 0 24 24" style="fill: #6C757D;transform: ;msFilter:;">
                                <path
                                    d="m21.426 11.095-17-8A.999.999 0 0 0 3.03 4.242L4.969 12 3.03 19.758a.998.998 0 0 0 1.396 1.147l17-8a1 1 0 0 0 0-1.81zM5.481 18.197l.839-3.357L12 12 6.32 9.16l-.839-3.357L18.651 12l-13.17 6.197z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endforeach
<script>
    function autoFillkomenB(id) {
        // Mendapatkan nilai dari Input A
        var komenA = document.getElementById("isi_komentarA" + id).value;

        // Mengisi nilai Input B dengan nilai Input A
        document.getElementById("isi_komentar" + id).value = komenA;
    }
</script>
