@extends('layouts.template', ['title' => 'Home'])
@section('content')
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            @for ($i = 0; $i < count($randomMovies); $i+=1)
                @if ($i == 0)
                    <div class="carousel-item active">
                        <div class="carousel-gradient active">
                            <img src="{{ asset('storage/movies/bg-image/'.$randomMovies[$i]->background_url) }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{$randomMovies[$i]->title}}</h5>
                            <p>{{$randomMovies[$i]->description}}</p>
                        </div>
                    </div>
                @else
                    <div class="carousel-item">
                        <div class="carousel-gradient active">
                            <img src="{{ asset('storage/movies/bg-image/'.$randomMovies[$i]->background_url) }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{$randomMovies[$i]->title}}</h5>
                            <p>{{$randomMovies[$i]->description}}</p>
                        </div>
                    </div>
                @endif
            @endfor
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@endsection
