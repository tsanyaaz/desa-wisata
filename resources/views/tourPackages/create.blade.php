@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> Tambah Data Paket Wisata</h1>
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
                            <form action="{{ route('tourPackages.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="tp_name" class="form-label">Nama Paket</label>
                                    <input type="text" class="form-control" id="tp_name" name="tp_name">
                                    @error('tp_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tp_desc" class="form-label">Deskripsi</label>
                                    <input type="text" class="form-control" id="tp_desc" name="tp_desc">
                                    @error('tp_desc')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tp_facilities" class="form-label">Fasilitas</label>
                                    <input type="text" class="form-control" id="tp_facilities" name="tp_facilities">
                                    @error('tp_facilities')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tp_price" class="form-label">Harga</label>
                                    <input type="number" class="form-control" id="tp_price" name="tp_price">
                                    @error('tp_price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tp_discount" class="form-label">Diskon</label>
                                    <input type="number" class="form-control" id="tp_discount" name="tp_discount">
                                    @error('tp_discount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="picture" class="form-label">Foto</label>
                                    <input type="file" class="form-control" id="picture" name="picture[]" multiple>
                                    @error('picture')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <a href="{{ route('tourPackages.index') }}" class="btn btn-secondary mt-3">Batal</a>
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