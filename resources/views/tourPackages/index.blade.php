@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Paket Wisata</h1>
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
                            <h3 class="card-title">Daftar Paket Wisata</h3>
                            <div class="card-tools">
                                <a class="btn btn-success rounded-pill" href="/tourPackages/create"><i class="fas fa-user-plus"></i> Tambah Paket Wisata</a>
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
                                        <form action="/tourPackages" method="GET">
                                            <input type="search" class="form-control search" placeholder="Cari Penginapan" name="search">
                                        </form>
                                    </div>
                                </div>
                                {{-- <div class="col-sm-4">
                                    <div class="form-group">
                                        <a href="/export" class="btn btn-primary"><i class="fas fa-download"></i> Export PDF</a>
                                    </div>
                                </div> --}}
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
                                        <th>Nama Paket</th>
                                        <th>Deskripsi</th>
                                        <th>Fasilitas</th>
                                        <th>Harga</th>
                                        <th>Diskon</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tourPackages as $number => $tourPackage)
                                    <tr>
                                        <td>{{ $number + $tourPackages->firstItem() }}</td>
                                        <td>{{ $tourPackage->tp_name }}</td>
                                        <td>{{ $tourPackage->tp_desc }}</td>
                                        <td>{{ $tourPackage->tp_facilities }}</td>
                                        <td>Rp.{{ $tourPackage->tp_price }}</td>
                                        <td>
                                            @if ($tourPackage->tp_discount)
                                                {{ $tourPackage->tp_discount }}%
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @foreach ($tourPackage->pictures as $picture)
                                                <img src="{{ asset($picture->path) }}" alt="{{  $tourPackage->ta_name }}" width="100">
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="/tourPackages/edit/{{ $tourPackage->id }}" class="btn btn-primary me-1"><i class="fas fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger delete ms-1" data-id="{{ $tourPackage->id }}"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $tourPackages->links() }}
                            @if (Session::has('page') && strpos(Session::get('page'), 'search') !== false)
                                <div class="mt-3">
                                    <a href="/tourPackages" class="btn btn-secondary">Kembali</a>
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
                    window.location = "/tourPackages/delete/" + $(this).data('id');
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
