@extends('layouts.user_type.auth')

@section('content')
<div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    <div class="nav-wrapper position-relative end-0 mt-4 ms-4">
        <a href="{{ route('dashboard') }}" class="btn bg-gradient-dark btn-sm mb-0">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Dashboard
        </a>
    </div>
    <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/back.jpg'); background-position-y: 50%;">
            <span class="mask bg-gradient-dark opacity-3"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
            <div class="row gx-4">

                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ $user->name }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            Pekerja
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="button_logout btn bg-gradient-dark mt-2">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-12 col-xl-8">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-0">Informasi Akun</h6>
                            </div>
                            <div class="col-md-4 text-end">
                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                    <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                                <strong class="text-dark">Username:</strong> &nbsp; {{ $user->username }}
                            </li>
                            <li class="list-group-item border-0 ps-0 text-sm">
                                <strong class="text-dark">Nama:</strong> &nbsp; {{ $user->name }}
                            </li>
                            <li class="list-group-item border-0 ps-0 text-sm">
                                <strong class="text-dark">Tanggal Lahir:</strong> &nbsp; {{ \Carbon\Carbon::parse($user->birthdate)->format('d-m-Y') }}
                            </li>
                            <li class="list-group-item border-0 ps-0 text-sm">
                                <strong class="text-dark">Kontak:</strong> &nbsp; {{ $user->kontak }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4 mt-3">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Ubah Password</h6>
                    </div>
                    <div class="card-body p-3">
                        <form action="{{ route('pekerja.update-password') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-control-label">Password Saat Ini</label>
                                <input type="password" name="current_password" class="form-control" required>
                                @error('current_password')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Password Baru</label>
                                <input type="password" name="new_password" class="form-control" required>
                                @error('new_password')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Konfirmasi Password Baru</label>
                                <input type="password" name="new_password_confirmation" class="form-control" required>
                                @error('new_password_confirmation')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            {{-- @if(session('error'))
                                <div class="alert alert-danger text-white text-sm mt-2">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if(session('success'))
                                <div class="alert alert-success text-white text-sm mt-2">
                                    {{ session('success') }}
                                </div>
                            @endif --}}
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-dark w-100 mt-4 mb-0">Ubah Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Ubah Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('pekerja.update-profile') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-control-label">Username</label>
                        <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn bg-gradient-dark">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
