@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> Edit Data Berita</h1>
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
                            <form action="/news/update/{{ $news->id }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="news_title" class="form-label">Judul Berita</label>
                                    <input id="news_title" type="text" class="form-control @error('news_title') is-invalid @enderror" name="news_title" value="{{ old('news_title', $news->news_title) }}" required autocomplete="news_title" autofocus>
                                </div>
                                <div class="mb-3">
                                    <label for="id_news_category" class="form-label">Kategori</label>
                                    <select class="form-control" name="id_news_category" id="id_news_category">
                                        @foreach ($newsCategories as $newsCategory)
                                            <option value="{{ $newsCategory->id }}" {{ $news->id_news_category == $newsCategory->id ? 'selected' : '' }}>{{ $newsCategory->nc_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_news_category')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="news_content" class="form-label">Konten Berita</label>
                                    <input id="news_content" type="text" class="form-control @error('news_content') is-invalid @enderror" name="news_content" value="{{ old('news_content', $news->news_content) }}" required autocomplete="news_content">
                                </div>
                                <div class="mb-3">
                                    <label for="news_date" class="form-label">Tanggal Unggah</label>
                                    <input id="news_date" type="date" class="form-control @error('news_date') is-invalid @enderror" name="news_date" value="{{ old('news_date', $news->news_date) }}" required autocomplete="news_date">
                                </div>
                                <div>
                                    <label for="picture" class="form-label">Foto</label>
                                    <br>
                                    @foreach ($news->pictures as $picture)
                                        <img src="{{ asset($picture->path) }}" alt="{{  $news->ta_name }}" width="100">
                                    @endforeach
                                    <input type="file" class="form-control mt-2" id="picture" name="picture[]"  multiple>
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