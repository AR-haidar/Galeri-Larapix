@extends('layouts.main')

@section('container')
    <div class="w-100">
        <div class="row p-3">
            <h3 class="fw-bold ">Cari Album</h3>
            <div class="col-4">
                <form class="d-flex" action="" method="get">
                    <input type="text" name="key" id="" class="form-control" placeholder="Masukkan kata kunci" autocomplete="off">
                    <button class="btn btn-sm btn-warning fw-bold ms-1" type="submit">Cari</button>
                </form>
            </div>
            <hr class="mt-3">
            <div class="col-12">
                <div class="row gap-3">
                    @forelse ($album as $item)
                            <a href="{{ url('/album/' . $item->album_id) }}"
                                class="col-4 album p-0 rounded rounded-2 text-decoration-none text-white"
                                style="
                                @if ($item->lokasi_file) background-image: url('{{ asset('storage/' . $item->lokasi_file) }}');
                                
                                @else
                                background-image: url('{{ asset('empty.svg') }}'); 
                                background-size: 40%; @endif
                                ">
                                <div class="position-absolute m-3">
                                    
                                </div>
                                <div class="fs-6 d-flex gradient align-items-end w-100 h-100 p-3 rounded rounded-2">
                                    <div class="d-block">
                                        <div class="fs-4 fw-bold">
                                            {{ $item->nama_album }} <span class="fw-normal fs-6">({{ $item->jumlah_foto }}
                                                Foto)</span>
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
