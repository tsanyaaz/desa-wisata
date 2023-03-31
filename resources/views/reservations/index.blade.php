@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Reservasi</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Reservasi</li>
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
                            <h3 class="card-title">Daftar Reservasi</h3>
                            {{-- <div class="card-tools">
                                <a class="btn btn-success" href="/touristAttractions/create"><i class="fas fa-user-plus"></i> Tambah Objek Wisata</a>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div> --}}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-sm-4">
                                    <div class="form-group">
                                        <form action="/touristAttractions" method="GET">
                                            <input type="search" class="form-control search" placeholder="Cari Pengguna" name="search">
                                        </form>
                                    </div>
                                </div> --}}
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
                                        <th>Nama Pelanggan</th>
                                        <th>Nama Paket</th>
                                        <th>Tanggal Reservasi</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Diskon</th>
                                        <th>Nilai Diskon</th>
                                        <th>Total Harga</th>
                                        <th>Bukti Transfer</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservations as $number => $reservation)
                                    <tr>
                                        <td>{{ $number + $reservations->firstItem() }}</td>
                                        <td>A</td>
                                        <td>B</td>
                                        <td>{{ $reservation->reservation_date }}</td>
                                        <td>{{ $reservation->reservation_price }}</td>
                                        <td>{{ $reservation->reservation_qty }}</td>
                                        <td>{{ $reservation->reservation_discount }}</td>
                                        <td>{{ $reservation->discount_value }}</td>
                                        <td>{{ $reservation->reservation_total }}</td>
                                        <td>{{ $reservation->tf_receiptfile }}</td>
                                        <td>{{ $reservation->reservation_status }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="/reservations/edit/{{ $reservation->id }}" class="btn btn-primary me-1"><i class="fas fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger delete ms-1" data-id="{{ $reservation->id }}"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $reservations->links() }}
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
                    window.location = "/reservations/delete/" + $(this).data('id');
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
