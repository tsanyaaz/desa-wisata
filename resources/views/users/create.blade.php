@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> Tambah Data Pengguna</h1>
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
                            <form action="{{ route('users.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="address" name="address">
                                    @error('address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Telepon</label>
                                    <input type="text" class="form-control" id="phone" name="phone">
                                    @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control password input-field" id="password" name="password">
                                    <span class="eye" onclick="myFunction()">
                                        <i id="show" class="fas fa-solid fa-eye"></i>
                                        <i id="hide" class="fas fa-solid fa-eye-slash"></i>
                                    </span>
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="password" class="form-label">Konfirmasi Password</label>
                                    <input type="password" class="form-control password input-field" id="password" name="password">
                                    <span class="eye" onclick="myFunction()">
                                        <i id="show" class="fas fa-solid fa-eye"></i>
                                        <i id="hide" class="fas fa-solid fa-eye-slash"></i>
                                    </span>
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="level" class="form-label">Level</label>
                                    <select class="form-control" id="level" name="level">
                                        <option value="Administrator">Administrator</option>
                                        <option value="Bendahara">Bendahara</option>
                                        {{-- <option value="Pelanggan">Pelanggan</option> --}}
                                        <option value="Pemilik">Pemilik</option>
                                    </select>
                                    @error('level')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Batal</a>
                                <button type="submit" class="btn btn-primary mt-3">Kirim</button>
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

<script>
    function myFunction() {
        var passField = document.getElementById("password");
        var showPass = document.getElementById("show");
        var hidePass = document.getElementById("hide");

        if (passField.type === "password") {
            passField.type = "text";
            showPass.style.display = "block";
            hidePass.style.display = "none";
        } else {
            passField.type = "password";
            showPass.style.display = "none";
            hidePass.style.display = "block";
        }
    }
</script>