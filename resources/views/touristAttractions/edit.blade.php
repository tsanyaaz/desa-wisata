@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Data Objek Wisata</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="/touristAttractions/update/{{ $touristAttractions->id }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="ta_name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="ta_name" name="ta_name" value="{{ $touristAttractions->ta_name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="id_tourism_category" class="form-label">Kategori</label>
                                    <select class="form-control" name="id_tourism_category" id="id_tourism_category">
                                        @foreach ($tourismCategories as $tourismCategory)
                                            <option value="{{ $tourismCategory->id }}" {{ $touristAttractions->id_tourism_category == $tourismCategory->id ? 'selected' : '' }}>{{ $tourismCategory->tc_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_tourism_category')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="ta_desc" class="form-label">Deskripsi</label>
                                    <input type="text" class="form-control" id="ta_desc" name="ta_desc" value="{{ $touristAttractions->ta_desc }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ta_facilities" class="form-label">Fasilitas</label>
                                    <input type="text" class="form-control" id="ta_facilities" name="ta_facilities" value="{{ $touristAttractions->ta_facilities }}" required>
                                </div>
                                <div>
                                    <label for="picture" class="form-label">Foto</label>
                                    <br>
                                    @foreach ($touristAttractions->pictures as $picture)
                                        <img src="{{ asset($picture->path) }}" alt="{{  $touristAttractions->ta_name }}" width="100">
                                    @endforeach
                                    <input type="file" class="form-control mt-2" id="picture" name="picture[]"  multiple>
                                </div>
                                <a href="{{ route('touristAttractions.index') }}" class="btn btn-secondary mt-3">Batal</a>
                                <button type="submit" class="btn btn-primary mt-3">Kirim</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection