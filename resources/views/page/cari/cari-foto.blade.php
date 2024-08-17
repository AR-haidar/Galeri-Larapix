@extends('layouts.main')

@section('container')
    <div class="w-100">
        <div class="row p-3 ">
            <h3 class="fw-bold ">Cari Foto</h3>
            <div class="col-4">
                <form class="d-flex" action="" method="get">
                    <input type="text" name="key" id="" class="form-control" placeholder="Masukkan kata kunci"
                        autocomplete="off">
                    <button class="btn btn-sm btn-warning fw-bold ms-1" type="submit">Cari</button>
                </form>
            </div>
            <hr class="mt-3">
            <div class="col-12">
                <div class="row gap-3 p-0">
                    @forelse ($foto as $item)
                        <a href="{{ url('/foto/' . $item->id) }}"
                            class="col-3 card text-decoration-none text-dark hover-user">

                            <div class="d-flex align-items-center mb-2 mt-2">
                                <img class="rounded-circle" src="{{ asset('storage/' . $item->profile) }}" alt=""
                                    style="width: 1.7rem; height: 1.7rem;">
                                <div class="d-block ms-2" style="font-size: .85rem">
                                    <div class="fw-bold">
                                        {{ $item->username }}
                                    </div>

                                </div>
                            </div>

                            <div class="w-100 h-100 rounded">
                                <img class="w-100 h-100 border-2 rounded" src="{{ asset('storage/' . $item->lokasi_file) }}"
                                    alt=""
                                    style="object-position: center; object-fit: cover; max-width: 100%; max-height: 100%">
                            </div>
                            <div class="my-2 d-block">
                                <div class="text-muted" style="font-size: .85rem">
                                    Album : {{ $item->nama_album }}
                                </div>
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
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
