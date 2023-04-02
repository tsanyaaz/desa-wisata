@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Objek Wisata</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Objek Wisata</li>
                        </ol>
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
                            <h3 class="card-title">Daftar Objek Wisata</h3>
                            <div class="card-tools">
                                <a class="btn btn-success" href="/touristAttractions/create"><i class="fas fa-user-plus"></i> Tambah Objek Wisata</a>
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
                                        <form action="/touristAttractions" method="GET">
                                            <input type="search" class="form-control search" placeholder="Cari Pengguna" name="search">
                                        </form>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <a href="/export" class="btn btn-primary"><i class="fas fa-download"></i> Export PDF</a>
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
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Deskripsi</th>
                                        <th>Fasilitas</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($touristAttractions as $number => $touristAttraction)
                                    <tr>
                                        <td>{{ $number + $touristAttractions->firstItem() }}</td>
                                        <td>{{ $touristAttraction->ta_name }}</td>
                                        <td>{{ $touristAttraction->tourismCategory->tc_name }}</td>
                                        <td>{{ $touristAttraction->ta_desc }}</td>
                                        <td>{{ $touristAttraction->ta_facilities }}</td>
                                        <td>
                                            @foreach ($touristAttraction->pictures as $picture)
                                                <img src="{{ asset($picture->path) }}" alt="{{  $touristAttraction->ta_name }}" width="100">
                                            @endforeach
                                            {{-- <img src="{{ asset('storage/touristAttractions/' . $touristAttraction->id . $touristAttraction->picture) }}" alt="{{ $touristAttraction->ta_name }}" width="100"> --}}
                                            {{-- <img src="{{ $touristAttraction->picture }}" alt="{{ $touristAttraction->ta_name }}" width="100"> --}}
                                            {{-- @foreach ($touristAttraction->pictures as $picture)
                                                <img src="{{ asset($picture->file_name) }}" alt="{{ $$touristAttraction->ta_name }}" width="100">
                                            @endforeach --}}
                                            {{-- <img src="{{ asset('tourAttractionPicts/') . $touristAttraction->picture->first()->file_name }}" alt="{{ $touristAttraction->ta_name }}"> --}}
                                            {{-- @if (!empty($touristAttractions))
                                                @foreach ($touristAttraction->pictures as $picture)
                                                    <img src="{{ asset('pictures/'.$picture->file_name) }}" alt="{{ $picture->file_name }}" width="200px">
                                                @endforeach
                                            @else
                                                -
                                                {{-- <img src="{{ asset('news_images/default.png') }}" alt="{{ $data->news_title }}" class="img-fluid" style="width: 200px"> --}}
                                            {{-- @endif --}} 
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="/touristAttractions/edit/{{ $touristAttraction->id }}" class="btn btn-primary me-1"><i class="fas fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger delete ms-1" data-id="{{ $touristAttraction->id }}"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $touristAttractions->links() }}
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
                    window.location = "/touristAttractions/delete/" + $(this).data('id');
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
