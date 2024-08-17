@extends('page.user.profil')
@section('user')
    <div class="w-100">
        <div class="row">
            <div class="col-12 ps-5">
                <div class="row gap-1 d-flex ps-5">
                    @forelse ($foto as $item)
                        <a href="{{ url('/foto/' . $item->id) }}" class="col-4 foto"
                            style="background-image: url('{{ asset('storage/' . $item->lokasi_file) }}'); ">
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
