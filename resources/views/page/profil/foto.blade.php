@extends('layouts.profil')
@section('profil')
    <div class="w-100">
        <div class="row">
            <div class="col-12 ps-5">
                <div class="row gap-1 d-flex ps-5">
                    @forelse ($foto as $item)
                        <a href="{{ url('/foto/' . $item->id) }}"
                            class="col-3 card text-decoration-none text-dark hover-user p-3 pb-0">
                            <div class="w-100 h-100 rounded">
                                <img class="w-100 h-100 border-2 rounded" src="{{ asset('storage/' . $item->lokasi_file) }}"
                                    alt=""
                                    style="object-position: center; object-fit: cover; max-width: 100%; max-height: 100%">
                            </div>
                            <div class="my-2 d-block">
                                <div class="d-flex justify-content-between align-items-center mt-2 fw-bold">
                                    <div class="fs-6 fw-bold">
                                        {{ $item->judul_foto }}
                                    </div>
                                    <div class="d-flex">
                                        <div class="like d-flex">
                                            <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="25"
                                                height="25" viewBox="0 0 24 24"
                                                style="fill:  rgba(255, 0, 0,1);transform: ;msFilter:;">
                                                <path
                                                    d="M20.205 4.791a5.938 5.938 0 0 0-4.209-1.754A5.906 5.906 0 0 0 12 4.595a5.904 5.904 0 0 0-3.996-1.558 5.942 5.942 0 0 0-4.213 1.758c-2.353 2.363-2.352 6.059.002 8.412L12 21.414l8.207-8.207c2.354-2.353 2.355-6.049-.002-8.416z">
                                                </path>
                                            </svg>
                                            {{ DB::table('likefoto')->where('foto_id', $item->id)->count() }}
                                        </div>
                                        <div class="komen ms-1 d-flex">
                                            <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="23"
                                                height="23" viewBox="0 0 24 24"
                                                style="fill: rgba(0, 0, 0, 1);transform: scaleX(-1);msFilter:progid:DXImageTransform.Microsoft.BasicImage(rotation=0, mirror=1);">
                                                <path
                                                    d="M20 2H4c-1.103 0-2 .897-2 2v18l5.333-4H20c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2zm0 14H6.667L4 18V4h16v12z">
                                                </path>
                                            </svg>
                                            {{ DB::table('komentarfoto')->where('foto_id', $item->id)->count() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <center>
                            <div class="d-flex justify-content-center align-items-center bg-light col-12"
                                style=" width: 320px; height: 320px; color:#b1b5b9;">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                        fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                        <path
                                            d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z" />
                                    </svg>
                                    <h6 class="mt-3">Belum Ada Postingan</h6>
                                </div>
                            </div>
                        </center>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
