@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Data Karyawan</h1>
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
                            {{-- <form action="/employees/update/{{ $employees->id }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $employees->name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ $employees->address }}">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Telepon</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $employees->phone }}">
                                </div>
                                <div class="mb-3">
                                    <label for="jobtitle" class="form-label">Jabatan</label>
                                    <select class="form-select" name="jobtitle">
                                        <option selected>{{ $employees->jobtitle }}</option>
                                        <option value="Administrator" >Administrator</option> 
                                        <option value="Bendahara" >Bendahara</option>
                                        <option value="Pemilik" >Pemilik</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form> --}}
                            <form action="{{ route('employees.update', $employees->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="id_user" class="form-label">Nama</label>
                                    <input type="text" class="form-control" value="{{ $employees->user->name }}" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ $employees->address }}">
                                    @error('address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Telepon</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $employees->phone }}">
                                    @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jobtitle" class="form-label">Jabatan</label>
                                    <select class="form-control" id="jobtitle" name="jobtitle">
                                        <option value="Administrator" @if ($employees->jobtitle == 'Administrator') selected @endif>Administrator</option>
                                        <option value="Bendahara" @if ($employees->jobtitle == 'Bendahara') selected @endif>Bendahara</option>
                                        <option value="Pemilik" @if ($employees->jobtitle == 'Pemilik') selected @endif>Pemilik</option>
                                    </select>
                                    @error('jobtitle')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection