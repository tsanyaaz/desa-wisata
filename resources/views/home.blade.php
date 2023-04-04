{{-- <!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
        
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        
        <!-- Poppins Font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

        <!-- Home CSS -->
        {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
        {{-- <link rel="stylesheet" href="{{ asset('home.css') }}">
        <title>Desa Wisata</title>
    </head>
    <body>
        <div id="home-page">
            <section id="navbar">
                <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
                    <div class="container">
                        <div>
                            <i class="fas fa-sharp fa-solid fa-house-user fa-2x"></i>
                            <a class="navbar-brand" href="#"><span>Desa Wisata</span></a>
                        </div>
                        
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto text-center">
                                <li class="nav-item">
                                    <a class="nav-link" href="#home">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#information">Informasi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tour-attraction">Objek Wisata</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#homestay">Penginapan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#reservation">Reservasi</a>
                                </li>
                            </ul>
                        </div> --}}
                        {{-- <div>
                            <div>
                                <img src="{{ asset('AdminLTE/dist/img/user-default-profile.png') }}" class="img-circle elevation-2" alt="User Image" style="width: 32px; margin-left: 16px;">
                            </div>
                        </div> --}}
                        {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                </nav>
            </section> --}}
            

            @extends('layouts.show_home')

            @section('showContent')
            <section  id="home">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-6 mt-2">
                            <h1 class="title" style="font-size: 64px">Desa Wisata<span>.</span></h1>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint porro delectus, a obcaecati provident culpa voluptatem error, ipsum aperiam maxime sit molestias, nisi soluta deserunt.</p>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center">
                            <img src="{{ asset('AdminLTE/dist/img/nature.png') }}" alt="Desa Wisata" style="width: 380px">
                        </div>
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,160L48,181.3C96,203,192,245,288,229.3C384,213,480,139,576,133.3C672,128,768,192,864,213.3C960,235,1056,213,1152,197.3C1248,181,1344,171,1392,165.3L1440,160L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg> --}}
                    </div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#77bfad" fill-opacity="1" d="M0,160L48,181.3C96,203,192,245,288,229.3C384,213,480,139,576,133.3C672,128,768,192,864,213.3C960,235,1056,213,1152,197.3C1248,181,1344,171,1392,165.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
            </section>
            <section id="information">
                <div class="container">
                    <div class="text-center">
                        <h2 class="title">Informasi</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint porro delectus, a obcaecati provident culpa voluptatem error, ipsum aperiam maxime sit molestias, nisi soluta deserunt.</p>
                    </div>
                    <div class="row text-center">
                        @foreach ($news as $data)
                        <div class="col-md-4">
                            <div class="card">
                                @if(count($data->pictures) > 0)
                                <img src="{{ asset($data->pictures[0]->path) }}" class="card-img-top" alt="{{ $data->ta_name }}">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $data->news_title }}</h5>
                                    <p class="card-text">{{ Str::limit($data->news_content), 25, '...' }}</p>
                                    <a href="/news/{{ $data->id }}" class="btn btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{-- <div class="row text-center">
                        <div class="col-md-4">
                            <div class="card">
                                <img src="..." class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="..." class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="..." class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,160L48,181.3C96,203,192,245,288,229.3C384,213,480,139,576,133.3C672,128,768,192,864,213.3C960,235,1056,213,1152,197.3C1248,181,1344,171,1392,165.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
            </section>
            
            <section id="tour-attraction">
                <div class="container">
                    <div class="text-center">
                        <h2 class="title">Objek Wisata</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint porro delectus, a obcaecati provident culpa voluptatem error, ipsum aperiam maxime sit molestias, nisi soluta deserunt.</p>
                    </div>
                    <div class="row text-center">
                        @foreach ($touristAttractions as $touristAttraction)
                        <div class="col-md-4">
                            <div class="card">
                                @if(count($touristAttraction->pictures) > 0)
                                <img src="{{ asset($touristAttraction->pictures[0]->path) }}" class="card-img-top" alt="{{ $touristAttraction->ta_name }}">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $touristAttraction->ta_name }}</h5>
                                    <p class="card-text">{{ Str::limit($touristAttraction->ta_desc, 25, '...') }}</p>
                                    <a href="/touristAttractions/{{ $touristAttraction->id }}" class="btn btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#77bfad" fill-opacity="1" d="M0,160L48,181.3C96,203,192,245,288,229.3C384,213,480,139,576,133.3C672,128,768,192,864,213.3C960,235,1056,213,1152,197.3C1248,181,1344,171,1392,165.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
            </section>

            {{-- <section id="homestay">
                <div class="container">
                    <div class="text-center">
                        <h2 class="title">Objek Wisata</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint porro delectus, a obcaecati provident culpa voluptatem error, ipsum aperiam maxime sit molestias, nisi soluta deserunt.</p>
                    </div>
                    <div class="row text-center">
                        @foreach ($homestays as $homestay)
                            <div class="col-md-4">
                                <div class="card">
                                    @if(count($homestay->pictures) > 0)
                                    <img src="{{ asset($homestay->pictures[0]->path) }}" class="card-img-top" alt="{{ $homestay->h_name }}">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $homestay->h_name }}</h5>
                                        <p class="card-text">{{ $homestay->h_desc }}</p>
                                        <a href="/homestays/{{ $homestay->id }}" class="btn btn-primary">Read More</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#77bfad" fill-opacity="1" d="M0,160L48,181.3C96,203,192,245,288,229.3C384,213,480,139,576,133.3C672,128,768,192,864,213.3C960,235,1056,213,1152,197.3C1248,181,1344,171,1392,165.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
            </section> --}}
            <section id="homestay">
                <div class="container">
                    <div class="row mb-3 justify-content-center text-center">
                        <div class="col">
                            <h2 class="title">Penginapan</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint porro delectus, a obcaecati provident culpa voluptatem error, ipsum aperiam maxime sit molestias, nisi soluta deserunt.</p>
                        </div>
                        <div class="row text-center">
                            @foreach ($homestays as $homestay)
                                <div class="col-md-4">
                                    <div class="card">
                                        @if(count($homestay->pictures) > 0)
                                        <img src="{{ asset($homestay->pictures[0]->path) }}" class="card-img-top" alt="{{ $homestay->h_name }}">
                                        @endif
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $homestay->h_name }}</h5>
                                            <p class="card-text">{{ Str::limit($homestay->h_desc, 25, '...') }}</p>
                                            <a href="/homestays/{{ $homestay->id }}" class="btn btn-primary">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,160L48,181.3C96,203,192,245,288,229.3C384,213,480,139,576,133.3C672,128,768,192,864,213.3C960,235,1056,213,1152,197.3C1248,181,1344,171,1392,165.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
            </section>
            {{-- <section id="homestay">
                <div class="container">
                    <div class="row mb-3 justify-content-center text-center">
                        <div class="col">
                            <h2 class="title">Penginapan</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint porro delectus, a obcaecati provident culpa voluptatem error, ipsum aperiam maxime sit molestias, nisi soluta deserunt.</p>
                        </div>
                        <div class="col-12 text-center">
                            <div class="row justify-content-center">
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card">
                                        <img src="..." class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,160L48,181.3C96,203,192,245,288,229.3C384,213,480,139,576,133.3C672,128,768,192,864,213.3C960,235,1056,213,1152,197.3C1248,181,1344,171,1392,165.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
            </section> --}}

            <section id="reservation">
                <div class="container">
                    <div class="row mb-3 justify-content-center text-center">
                        <div class="col">
                            <h2>Reservasi</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint porro delectus, a obcaecati provident culpa voluptatem error, ipsum aperiam maxime sit molestias, nisi soluta deserunt.</p>
                            <a href="#" class="btn btn-primary me-2">Reservasi Sekarang!</a>
                        </div>
                    </div>
                </div>
            </section>
            @endsection
        {{-- </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    </body>
</html> --}}