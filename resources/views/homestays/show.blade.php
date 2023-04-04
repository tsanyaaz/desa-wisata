@extends('layouts.show_home')
@section('showContent')
    <div class="container">
        <div class="text-center" style="margin-top: 100px">
            <h2 class="title">{{ $homestays->h_name }}</h2>
            @foreach ($homestays->pictures as $picture)
                <img src="{{ asset($picture->path) }}" alt="{{ $homestays->h_name }}" width="350" height="250" style="border-radius: 15%">
            @endforeach
            <p class="mt-3">{{ $homestays->h_desc }}</p>
        </div>
    </div>
@endsection

