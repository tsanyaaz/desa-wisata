@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> Tambah Data Objek Wisata</h1>
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
                            <form action="{{ route('touristAttractions.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="ta_name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="ta_name" name="ta_name">
                                    @error('ta_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="id_tourism_category" class="form-label">Kategori</label>
                                    <select class="form-control" name="id_tourism_category" id="id_tourism_category">
                                        @foreach ($tourismCategories as $tourismCategory)
                                            <option value="{{ $tourismCategory->id }}">{{ $tourismCategory->tc_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_tourism_category')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="ta_desc" class="form-label">Deskripsi</label>
                                    <input type="text" class="form-control" id="ta_desc" name="ta_desc">
                                    @error('ta_desc')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="ta_facilities" class="form-label">Fasilitas</label>
                                    <input type="text" class="form-control" id="ta_facilities" name="ta_facilities">
                                    @error('ta_facilities')
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