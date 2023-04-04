@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Pengguna</h1>
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
                            <h3 class="card-title">Daftar Pengguna</h3>
                            <div class="card-tools">
                                <a class="btn btn-success rounded-pill" href="/users/create"><i class="fas fa-user-plus"></i> Tambah Pengguna</a>
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
                                        <form action="/users" method="GET">
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
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Level</th>
                                        <th>Status</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Tanggal Diupdate</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $number => $user)
                                    <tr>
                                        <td>{{ $number + $users->firstItem() }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->level }}</td>
                                        <td class="text-center">{{ $user->aktif == 1 ? 'Aktif' : 'Nonaktif' }}</td>
                                        <td class="text-center">{{ $user->created_at }}</td>
                                        <td class="text-center">{{ $user->updated_at }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="/users/edit/{{ $user->id }}" class="btn btn-primary me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit User"><i class="fas fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger delete me-1" data-id="{{ $user->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete User"><i class="fas fa-trash"></i></button>
                                                @if($user->aktif == 1)
                                                    <form action="{{ route('users.deactivate', $user->id) }}" method="POST" style="display:inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Deactivate User"><i class="fa fa-ban"></i></button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('users.activate', $user->id) }}" method="POST" style="display:inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Activate User"><i class="fas fa-toggle-on"></i></button>
                                                    </form>
                                                @endif
                                            </div>
                                              
                                            {{-- <div class="btn-group">
                                                <a href="/users/edit/{{ $user->id }}" class="btn btn-primary me-1"><i class="fas fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger delete me-1" data-id="{{ $user->id }}"><i class="fas fa-trash"></i></button>
                                                @if($user->aktif == 1)
                                                    <form action="{{ route('users.deactivate', $user->id) }}" method="POST" style="display:inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-danger"><i class="fa fa-ban"></i></button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('users.activate', $user->id) }}" method="POST" style="display:inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success"><i class="fas fa-toggle-on"></i></i></button>
                                                    </form>
                                                @endif
                                            </div> --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $users->links() }}
                            @if (Session::has('page') && strpos(Session::get('page'), 'search') !== false)
                                <div class="mt-3">
                                    <a href="/users" class="btn btn-secondary">Kembali</a>
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
                    window.location = "/users/delete/" + $(this).data('id');
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
