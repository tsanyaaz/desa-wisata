@extends('layouts.dashboard')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <img src="{{ asset('AdminLTE/dist/img/user-default-profile.png') }}" class="rounded-circle mb-3" alt="User Image">
                        <h2 class="mb-1">{{ Auth::user()->name }}</h2>
                        <p class="mb-0 font-weight-bold text-sm">{{ Auth::user()->level }}</p>
                    </div>
                    <form method="POST" action="/users/profile/update/" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <input id="address" type="text" class="form-control" name="address" value="{{ Auth::user()->address }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">No. Telepon</label>
                            <input id="phone" type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control" name="password">
                        </div>
                        <div>
                            <label for="picture" class="form-label">Foto</label>
                            <br>
                            @foreach ($users->pictures as $picture)
                                <img src="{{ asset($picture->path) }}" alt="{{  $users->h_name }}" width="100">
                            @endforeach
                            <input type="file" class="form-control mt-2" id="picture" name="picture[]"  multiple>
                        </div>
                        <a href="/users/profile" class="btn btn-secondary mt-3">Batal</a>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    @endsection