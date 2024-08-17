<div class="sidebar-content">
    <div class="sidebar-header pt-4">
        <a class="text-decoration-none" href="{{ url('/') }}">
            <h1 class="h3 text-dark text-center fw-bold" style="font-weight: 900;">Lara<span
                    class="text-warning">pix</span></h1>
        </a>
    </div>
    <div class="sidebar-body mt-5">

        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="{{ route('home') }}"
                    class="sidebar-link text-dark text-dark {{ Request::is('/') ? 'fw-bold' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                        <path
                            d="M12.71 2.29a1 1 0 0 0-1.42 0l-9 9a1 1 0 0 0 0 1.42A1 1 0 0 0 3 13h1v7a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-7h1a1 1 0 0 0 1-1 1 1 0 0 0-.29-.71zM6 20v-9.59l6-6 6 6V20z">
                        </path>
                    </svg>
                    <span class="align-middle" style="margin-top: 20px;">Beranda</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link text-dark {{ Request::is('cari*') ? 'fw-bold' : '' }} dropdown-toggle"
                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                        <path
                            d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z">
                        </path>
                    </svg>
                    Telusuri
                </a>
                <ul class="dropdown-menu shadow">
                    <li>
                        <a class="dropdown-item fs-6 {{ Request::is('cari/user*') ? 'bg-opacity-10 bg-black' : '' }}"
                            href="{{ url('cari/user') }}">Telusuri User</a>
                    </li>
                    <li>
                        <a class="dropdown-item fs-6 {{ Request::is('cari/foto*') ? 'bg-opacity-10 bg-black' : '' }}"
                            href="{{ url('cari/foto') }}">Telusuri Foto</a>
                    </li>
                    <li>
                        <a class="dropdown-item fs-6 {{ Request::is('cari/album*') ? 'bg-opacity-10 bg-black' : '' }}"
                            href="{{ url('cari/album') }}">Telusuri Album</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('post-album') }}"
                    class="sidebar-link text-dark {{ Request::is('post-album*') ? 'fw-bold' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                        <path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4z"></path>
                        <path
                            d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z">
                        </path>
                    </svg>
                    <span class="align-middle">Buat Album</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('post-photo') }}"
                    class="sidebar-link text-dark {{ Request::is('post-photo*') ? 'fw-bold' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                        <path d="M13 7h-2v4H7v2h4v4h2v-4h4v-2h-4z"></path>
                        <path
                            d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z">
                        </path>
                    </svg>
                    <span class="align-middle">Unggah Foto</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('profil') }}"
                    class="sidebar-link text-dark {{ Request::is('profil*') ? 'fw-bold' : '' }}">
                    @if (auth()->user()->profile)
                        <img class="rounded rounded-circle me-2 {{ Request::is('profil*') ? 'border-dark border' : '' }}"
                            src="{{ asset('storage/' . auth()->user()->profile) }}" alt=""
                            style="width: 24px; height: 24px;">
                    @else
                        <img class="rounded rounded-circle me-2 {{ Request::is('profil*') ? 'border-dark border' : '' }}"
                            src="{{ asset('profil.jpg') }}" alt="" style="width: 24px; height: 24px;">
                    @endif
                    <span class="align-middle" style="margin-left: 2px;">{{ auth()->user()->username }}</span>
                </a>
            </li>
        </ul>

    </div>
</div>
