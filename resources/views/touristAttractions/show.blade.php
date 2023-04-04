@extends('layouts.show_home')
@section('showContent')
    <div class="container">
        <div class="text-center" style="margin-top: 100px">
            <h2 class="title">{{ $touristAttractions->ta_name }}</h2>
            @foreach ($touristAttractions->pictures as $picture)
                <img src="{{ asset($picture->path) }}" alt="{{ $touristAttractions->ta_name }}" width="350" height="250" style="border-radius: 15%">
            @endforeach
            <p class="mt-3">{{ $touristAttractions->ta_desc }}</p>
        </div>
    </div>
@endsection

