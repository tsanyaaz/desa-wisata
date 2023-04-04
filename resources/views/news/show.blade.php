@extends('layouts.show_home')
@section('showContent')
    <div class="container">
        <div class="text-center" style="margin-top: 100px">
            <h2 class="title">{{ $news->news_title }}</h2>
            @foreach ($news->pictures as $picture)
                <img src="{{ asset($picture->path) }}" alt="{{ $news->news_title }}" width="350" height="250" style="border-radius: 15%">
            @endforeach
            <p class="mt-3">{{ $news->news_content }}</p>
        </div>
    </div>
@endsection

