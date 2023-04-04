<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Desa Wisata</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
    <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.slim.js" integrity="sha256-dWvV84T6BhzO4vG6gWhsWVKVoa4lVmLnpBOZh/CAHU4=" crossorigin="anonymous"></script>
    {{-- CSS Show Password --}}
    <link rel="stylesheet" href="{{ asset('showpass.css') }}">
</head>
    <body class="hold-transition  sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">

            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <i class="animation__wobble fas fa-sharp fa-solid fa-house-user" alt="DesaWisata" height="60" width="60"></i>
                {{-- <img class="animation__wobble" src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60"> --}}
            </div>

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-dark">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="/" class="brand-link" style="text-decoration: none">
                    <i class="fas fa-sharp fa-solid fa-house-user"></i>
                    <span class="brand-text font-weight-light">Desa Wisata</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{ asset('AdminLTE/dist/img/user-default-profile.png') }}" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="/users/profile/" class="d-block" style="text-decoration: none">{{ Auth::user()->name }}</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                            with font-awesome or any other icon font library -->
                            <li class="nav-item">
                                <a href="{{ Auth::user()->level == 'Pelanggan' ? '/' : '/dashboard' }}" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        {{ Auth::user()->level == 'Pelanggan' ? 'Home' : 'Dashboard' }}
                                    </p>
                                </a>
                            </li>
                            @if (Auth::user()->level == 'Administrator')
                                <li class="nav-item">
                                    <a href="/users" class="nav-link">
                                        <i class="nav-icon fas fa-sharp fa-solid fa-users"></i>
                                        <p>
                                            Pengguna
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/employees" class="nav-link">
                                        <i class="nav-icon fas fa-sharp fa-solid fa-user"></i>
                                        <p>
                                            Karyawan
                                        </p>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->level == 'Administrator' || Auth::user()->level == 'Bendahara')
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-solid fa-tree"></i>
                                        <p>
                                            Wisata
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if (Auth::user()->level == 'Administrator')
                                        <li class="nav-item">
                                            <a href="/tourismCategories" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Kategori Wisata</p>
                                            </a>
                                        </li>
                                        @endif
                                        @if (Auth::user()->level == 'Administrator')
                                        <li class="nav-item">
                                            <a href="/touristAttractions" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Objek Wisata</p>
                                            </a>
                                        </li>
                                        @endif
                                        @if (Auth::user()->level == 'Bendahara')
                                        <li class="nav-item">
                                            <a href="/tourPackages" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Paket Wisata</p>
                                            </a>
                                        </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif
                            @if (Auth::user()->level == 'Administrator')
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-regular fa-newspaper"></i>
                                    <p>
                                        Berita
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="/newsCategories" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Kategori Berita</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/news" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Isi Berita</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="/homestays" class="nav-link">
                                    <i class="nav-icon fas fa-sharp fa-solid fa-house-user"></i>
                                    <p>
                                        Penginapan
                                    </p>
                                </a>
                            </li>
                            @endif
                            @if (!in_array(Auth::user()->level, ['Administrator', 'Pelanggan']))
                            <li class="nav-item">
                                <a href="/reservations" class="nav-link">
                                    <i class="nav-icon fas fa-solid fa-book"></i>
                                    <p>
                                        Reservasi
                                    </p>
                                </a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a href="/logout" class="nav-link">
                                    <i class="nav-icon fas fas fa-sign-out-alt"></i>
                                    <p>
                                        Logout
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            @yield('content')
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
            {{-- <footer class="main-footer">
                <strong>Copyright &copy; 2023 <a href="/">Desa Wisata</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                <b>TsanyA</b>
                </div>
            </footer> --}}
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('AdminLTE/dist/js/adminlte.js') }}"></script>

        <!-- PAGE PLUGINS -->
        <!-- jQuery Mapael -->
        <script src="{{ asset('AdminLTE/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
        <script src="{{ asset('AdminLTE/plugins/raphael/raphael.min.js') }}"></script>
        <script src="{{ asset('AdminLTE/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
        <script src="{{ asset('AdminLTE/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
        <!-- ChartJS -->
        <script src="{{ asset('AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>

        <!-- AdminLTE for demo purposes -->
        {{-- <script src="{{ asset('AdminLTE/dist/js/demo.js') }}"></script> --}}
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('AdminLTE/dist/js/pages/dashboard2.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        @stack('scripts')
    </body>
</html>
