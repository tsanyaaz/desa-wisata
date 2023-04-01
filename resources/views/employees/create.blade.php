@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> Tambah Data Karyawan</h1>
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
                            <form action="{{ route('employees.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                    @error('password_confirmation')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="level" class="form-label">Level</label>
                                    <select class="form-control" id="level" name="level">
                                        <option value="Administrator">Administrator</option>
                                        <option value="Bendahara">Bendahara</option>
                                        {{-- <option value="Pelanggan">Pelanggan</option> --}}
                                        <option value="Pemilik">Pemilik</option>
                                    </select>
                                    @error('level')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                {{-- <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <select class="form-control" id="name" name="name" onchange="setJabatan()">
                                        @foreach($users as $user)
                                            @if($user->level == 'Administrator' || $user->level == 'Bendahara' || $user->level == 'Pemilik')
                                                <option value="{{ $user->name }}" data-nama="{{ $user->name }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    {{-- <input type="text" class="form-control" id="name" name="name"> --
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div> --}}
                                {{-- <div class="mb-3">
                                    <label for="id_user" class="form-label">Nama</label>
                                    <select class="form-control" id="id_user" name="id_user" onchange="setJabatan()">
                                        @foreach($users as $user)
                                            @if(!in_array($user->id, $addedIds) && ($user->level == 'Administrator' || $user->level == 'Bendahara' || $user->level == 'Pemilik'))
                                                <option value="{{ $user->id }}" data-nama="{{ $user->name }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('id_user')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="address" name="address">
                                    @error('address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Telepon</label>
                                    <input type="text" class="form-control" id="phone" name="phone">
                                    @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jobtitle" class="form-label">Jabatan</label>
                                    <select class="form-control" id="jobtitle" name="jobtitle">
                                        <option value="Administrator">Administrator</option>
                                        <option value="Bendahara">Bendahara</option>
                                        <option value="Pemilik">Pemilik</option>
                                    </select>
                                    @error('jobtitle')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Submit</button> --}}
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

{{-- <script>
    function setJabatan() {
        var selectedId = document.getElementById("id_user").value;
        var users = {!! json_encode($users) !!};
        var selectedUser = users.find(function(user) {
            return user.id == selectedId;
        });
        if (selectedUser) {
            var jobtitle = "";
            if (selectedUser.level === "Administrator") {
                jobtitle = "Administrator";
            } else if (selectedUser.level === "Bendahara") {
                jobtitle = "Bendahara";
            } else if (selectedUser.level === "Pemilik") {
                jobtitle = "Pemilik";
            }
            document.getElementById("jobtitle").value = jobtitle;
        }
    }

    
</script> --}}
