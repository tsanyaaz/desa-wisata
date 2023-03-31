@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> Edit Data Paket Wisata</h1>
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
                            <form action="/tourPackages/update/{{ $tourPackages->id }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="tp_name" class="form-label">Nama Paket</label>
                                    <input type="text" class="form-control" id="tp_name" name="tp_name" value="{{ $tourPackages->tp_name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="tp_desc" class="form-label">Deskripsi</label>
                                    <input type="text" class="form-control" id="tp_desc" name="tp_desc" value="{{ $tourPackages->tp_desc }}">
                                </div>
                                <div class="mb-3">
                                    <label for="tp_facilities" class="form-label">Fasilitas</label>
                                    <input type="text" class="form-control" id="tp_facilities" name="tp_facilities" value="{{ $tourPackages->tp_facilities }}">                                    
                                </div>
                                <div class="mb-3">
                                    <label for="tp_price" class="form-label">Harga</label>
                                    <input type="number" class="form-control" id="tp_price" name="tp_price" value="{{ $tourPackages->tp_price }}">
                                </div>
                                <div class="mb-3">
                                    <label for="tp_discount" class="form-label">Diskon</label>
                                    <input type="number" class="form-control" id="tp_discount" name="tp_discount" value="{{ $tourPackages->tp_discount }}">
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