@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Berita</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Berita</h3>
                            <div class="card-tools">
                                <a class="btn btn-success rounded-pill" href="/news/create"><i class="fas fa-user-plus"></i> Tambah Berita</a>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <form action="/news" method="GET">
                                            <input type="search" class="form-control search" placeholder="Cari Pengguna" name="search">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    {{ $message }}
                                </div>
                            @endif
                            <table class="table table-bordered mb-3">
                                <thead>
                                    <tr class="text-center">
                                        <th style="width: 10px">#</th>
                                        <th>Judul Berita</th>
                                        <th>Kategori</th>
                                        <th>Konten Berita</th>
                                        <th>Unggah</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($news as $number => $data)
                                    <tr>
                                        <td>{{ $number + $news->firstItem() }}</td>
                                        <td>{{ $data->news_title }}</td>
                                        <td>{{ $data->newsCategory->nc_name }}</td>
                                        <td>{{ $data->news_content }}</td>
                                        <td>{{ $data->news_date }}</td>
                                        <td>
                                            @foreach ($data->pictures as $picture)
                                                <img src="{{ asset($picture->path) }}" alt="{{  $data->news_title }}" width="100">
                                            @endforeach
                                            {{-- @if ($data->news_image)
                                                <img src="{{ asset('news_images/'.$data->news_image) }}" alt="{{ $data->news_title }}" class="img-fluid" style="width: 200px">
                                            @else
                                                -
                                                {{-- <img src="{{ asset('news_images/default.png') }}" alt="{{ $data->news_title }}" class="img-fluid" style="width: 200px"> --}}
                                            {{-- @endif --}}
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="/news/edit/{{ $data->id }}" class="btn btn-primary me-1"><i class="fas fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger delete ms-1" data-id="{{ $data->id }}"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $news->links() }}
                            @if (Session::has('page') && strpos(Session::get('page'), 'search') !== false)
                                <div class="mt-3">
                                    <a href="/news" class="btn btn-secondary">Kembali</a>
                                </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.delete').click( function(){
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/news/delete/" + $(this).data('id');
                    swal("Poof! Your imaginary file has been deleted!", {
                    icon: "success",
                    });
                } else {
                    swal("Your imaginary file is safe!");
                }
            });
        })
    </script>
@endpush
