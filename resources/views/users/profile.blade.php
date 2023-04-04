@extends('layouts.dashboard')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div>
                        <i class="fas fa-gear "></i>
                    </div>
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <img src="{{ asset('AdminLTE/dist/img/user-default-profile.png') }}" class="rounded-circle mb-3" alt="User Image">
                        <h2 class="mb-1">{{ Auth::user()->name }}</h2>
                        <p class="mb-0 font-weight-bold text-sm">{{ Auth::user()->level }}</p>
                    </div>
                    <div>
                        <a href="/users/profile/edit" class="btn btn-primary">Edit Profil</a>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <input id="address" type="text" class="form-control" name="address" value="{{ Auth::user()->address }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">No. Telepon</label>
                        <input id="phone" type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="text" class="form-control" name="email" value="{{ Auth::user()->email }}" readonly>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
@endsection