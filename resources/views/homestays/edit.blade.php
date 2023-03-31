@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> Edit Data Penginapan</h1>
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
                            <form action="/homestays/update/{{ $homestays->id }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="h_name" class="form-label">Nama Penginapan</label>
                                    <input type="text" class="form-control" id="h_name" name="h_name" value="{{ $homestays->h_name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="h_desc" class="form-label">Deskripsi</label>
                                    <input type="text" class="form-control" id="h_desc" name="h_desc" value="{{ $homestays->h_desc }}">
                                </div>
                                <div class="mb-3">
                                    <label for="h_facilities" class="form-label">Fasilitas</label>
                                    <input type="text" class="form-control" id="h_facilities" name="h_facilities" value="{{ $homestays->h_facilities }}">                                    
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