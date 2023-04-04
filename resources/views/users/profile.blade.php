@extends('layouts.dashboard')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div>
                        
                        <div>
                            <a href="/users/profile/edit" class="btn btn-primary rounded-pill">Edit Profil</a>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        @if (Auth::user()->pictures->count() > 0)
                            <img src="{{ asset(Auth::user()->pictures->first()->path) }}" class="rounded-circle mb-3" alt="User Image" style="width: 300px">
                        @else
                            <img src="{{ asset('AdminLTE/dist/img/user-default-profile.png') }}" class="rounded-circle mb-3" alt="User Image" style="width: 300px">
                        @endif
                        <h2 class="mb-1">{{ Auth::user()->name }}</h2>
                        <p class="mb-0 font-weight-bold text-sm">{{ Auth::user()->level }}</p>
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