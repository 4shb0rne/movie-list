@extends('layouts.template', ['title' => 'Detail'])
@section('header')
    <link rel="stylesheet" href="{{ asset('css/movie.css') }}">
@endsection
@section('content')
    <div>
        <div class="movie-detail-background"
            style='
            background:
                linear-gradient(
                    rgba(0, 0, 0, 0.3),
                    rgba(0, 0, 0, 0.7)),
                    url({{ asset('storage/movies/bg-image/' . $movie->background_url) }})
                    no-repeat;
            background-size: cover;
            background-position: center;'>
            <div class="movie-detail row">
                <div class="col-3   ">
                    <img class="movie-detail-image" src="{{ asset('storage/movies/thumbnail/' . $movie->image_url) }}"
                        alt="">
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <h1>{{ $movie->title }}</h1>
                    </div>
                    <div class="mb-3 d-flex flex-wrap">
                        @foreach ($genres as $genre)
                            <button class="genre-pill fw-bold">{{ $genre->name }}</button>
                        @endforeach
                    </div>
                    <div class="mb-3">
                        <h5><i class="fa-solid fa-calendar-days fs-4"></i>&nbsp; {{ $movie->release_date->format('Y') }}
                        </h5>
                    </div>
                    <div class="mb-3">
                        <h3>Storyline</h3>
                        <h6 class="text-gray">{{ $movie->description }}</h6>
                    </div>
                    <div class="mb-3">
                        <h3>{{ $movie->director }}</h3>
                        <h6 class="text-gray">Director</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-container">
            <h5 class="mb-2">Casts</h5>
            <div class="d-flex flex-row flex-wrap">
                @foreach ($actors as $actor)
                    <div class="card background-red" style="width: 16rem;">
                        <img src="{{ asset('storage/actors/'.$actor->image_url) }}" class="actor-image" alt="...">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h6 class="card-title">{{$actor->name}}</h6>
                            <p class="card-text">{{$actor->character_name}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="content-container">
            <h5 class="mb-2">More</h5>
            <div class="d-flex flex-row flex-wrap">
                @foreach ($more as $m)
                    <a href="{{ route('movie-detail', $m->id) }}">
                        <div class="card bg-dark" style="width: 16rem;">
                            <img src="{{ asset('storage/movies/thumbnail/'.$m->image_url) }}" class="actor-image" alt="...">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h6 class="card-title">{{$m->title}}</h6>
                                <p class="card-text">{{Str::limit($m->description, 20) }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
