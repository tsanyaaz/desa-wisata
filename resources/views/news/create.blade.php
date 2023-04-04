@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> Tambah Data Berita</h1>
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
                            <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="news_title" class="form-label">Judul Berita</label>
                                    <input type="text" class="form-control" id="news_title" name="news_title">
                                    @error('news_title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="id_news_category" class="form-label">Kategori</label>
                                    <select class="form-control" name="id_news_category" id="id_news_category">
                                        @foreach ($newsCategories as $newsCategory)
                                            <option value="{{ $newsCategory->id }}">{{ $newsCategory->nc_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_news_category')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="news_content" class="form-label">Konten Berita</label>
                                    <input type="text" class="form-control" id="news_content" name="news_content">
                                    @error('news_content')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="news_date" class="form-label">Tanggal Unggah</label>
                                    <input type="date" class="form-control" id="news_date" name="news_date">
                                    @error('news_date')
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
                                <a href="{{ route('news.index') }}" class="btn btn-secondary mt-3">Batal</a>
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