@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> Edit Data Pengguna</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="/users/update/{{ $users->id }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $users->name) }}" required autocomplete="name" autofocus>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $users->email) }}" required autocomplete="email">
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password', $users->password) }}" required autocomplete="password">
                                </div> --}}
                                <div class="mb-3">
                                    <label for="level" class="form-label">Level</label>
                                    <select id="level" class="form-control @error('level') is-invalid @enderror" name="level" required>
                                        <option value="Pelanggan" @if (old('level', $users->level) === 'Pelanggan') selected @endif>Pelanggan</option>
                                        <option value="Administrator" @if (old('level', $users->level) === 'Administrator') selected @endif>Administrator</option>
                                        <option value="Bendahara" @if (old('level', $users->level) === 'Bendahara') selected @endif>Bendahara</option>
                                        <option value="Pemilik" @if (old('level', $users->level) === 'Pemilik') selected @endif>Pemilik</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
@endsection