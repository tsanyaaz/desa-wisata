@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Karyawan</h1>
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
                            <h3 class="card-title">Daftar Karyawan</h3>
                            <div class="card-tools">
                                <a class="btn btn-success rounded-pill" href="/employees/create"><i class="fas fa-user-plus"></i>Tambah Karyawan</a>
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
                                        <form action="/employees" method="GET">
                                            <input type="search" class="form-control search" placeholder="Cari Karyawan" name="search">
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
                                        {{-- <th style="width: 10px">#</th> --}}
                                        <th>Nama</th>
                                        {{-- <th>Email</th> --}}
                                        <th>Alamat</th>
                                        <th>Telepon</th>
                                        <th>Jabatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $number => $employee)
                                        @if($employee->level == 'Administrator' || $employee->level == 'Bendahara' || $employee->level == 'Pemilik')       
                                            <tr>
                                                {{-- <td>{{ $number + $employees->firstItem() }}</td> --}}
                                                <td>{{ $employee->name }}</td>
                                                {{-- <td>{{ $employee->email }}</td> --}}
                                                <td>{{ $employee->address }}</td>
                                                <td>{{ $employee->phone }}</td>
                                                <td>{{ $employee->level }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a href="/employees/edit/{{ $employee->id }}" class="btn btn-primary me-1"><i class="fas fa-edit"></i></a>
                                                        <button type="button" class="btn btn-danger delete ms-1" data-id="{{ $employee->id }}"><i class="fas fa-trash"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $employees->links() }}
                            @if (Session::has('page') && strpos(Session::get('page'), 'search') !== false)
                                <div class="mt-3">
                                    <a href="/employees" class="btn btn-secondary">Kembali</a>
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
                    window.location = "/employees/delete/" + $(this).data('id');
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
