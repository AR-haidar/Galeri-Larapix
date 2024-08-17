@extends('layouts.main')

@section('container')
    <div class="w-100">
        <div class="row p-3">
            <h3 class="fw-bold ">Cari User</h3>
            <div class="col-4">

                <form class="d-flex" action="" method="get">
                    {{-- @csrf --}}
                    <input type="text" name="key" id="" class="form-control" placeholder="Masukkan kata kunci"
                        autocomplete="off">
                    <button class="btn btn-sm btn-warning fw-bold ms-1" type="submit">Cari</button>
                </form>

            </div>
            <hr class="mt-3">
            <div class="col-12">
                <div class="row g-1">
                    @forelse ($user as $item)
                        <div class="col-12">
                            <a href="{{ url('/profil/' . $item->id) }}"
                                class="text-decoration-none text-dark ms-3 d-flex align-items-center border py-2 px-2 hover-user"
                                style="width: 30%">
                                <div class="">
                                    @if ($item->profile)
                                        <img class="rounded-circle border" src="{{ asset('storage/' . $item->profile) }}"
                                            alt="" style="width:2.6rem; height: 2.6rem; object-fit: cover; ">
                                    @else
                                        <img class="rounded-circle border" src="{{ asset('profil.jpg') }}" alt=""
                                            style="width:2.6rem">
                                    @endif
                                </div>
                                <div class="d-block ms-2">
                                    <div class="fw-bold">
                                        {{ $item->username }}
                                    </div>
                                    <div class="text-muted" style="font-size: .85rem">
                                        {{ $item->nama_lengkap }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
