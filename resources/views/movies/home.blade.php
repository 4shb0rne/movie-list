@extends('layouts.template', ['title' => 'Home'])
@section('header')
    <script src="{{ asset('js/index.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('js/lightslider.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('css/movie.css') }}">
@endsection
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
            @for ($i = 0; $i < count($randomMovies); $i += 1)
                @if ($i == 0)
                    <div class="carousel-item active">
                        <div class="carousel-gradient active">
                            <img src="{{ asset('storage/movies/bg-image/' . $randomMovies[$i]->background_url) }}"
                                class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{ $randomMovies[$i]->title }}</h5>
                            <p>{{ $randomMovies[$i]->description }}</p>
                        </div>
                    </div>
                @else
                    <div class="carousel-item">
                        <div class="carousel-gradient active">
                            <img src="{{ asset('storage/movies/bg-image/' . $randomMovies[$i]->background_url) }}"
                                class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{ $randomMovies[$i]->title }}</h5>
                            <p>{{ $randomMovies[$i]->description }}</p>
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
    <div class="m-3">
        <div class="d-flex flex-row align-items-center">
            <i class="fa-solid fa-fire-flame-curved text-light me-2 fs-3"></i>
            <span class="fs-3 m-0 fw-bold">Popular</span>
        </div>
        <ul class="movie-slider card-group list-unstyled cs-hidden" id="movieSlider">
            @foreach ($trendingMovies as $tm)
                <li class="card m-2 background-dark-accent">
                    <img src="{{ asset('storage/movies/thumbnail/' . $tm->image_url) }}" class="card-img-top movie-item-image">
                    <div class="card-body background-dark-accent justify-content-between d-flex flex-column">
                        <h5 class="card-title">{{$tm->title}}</h5>
                        <p class="card-text"><small class="text-muted">{{$tm->release_date->format('Y')}}</small></p>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="my-2 container-fluid text-light">
            <div class="d-flex flex-row align-items-center justify-content-between">
                <div class="d-flex flex-row align-items-center">
                    <i class="fa-solid fa-film me-2 fs-3"></i>
                    <span class="fs-3 m-0 fw-bold">Movies</span>
                </div>
                <div>
                    <input type="text" class="movie-search p-3 text-light" id="search-movie" placeholder="Search movie...">
                </div>
            </div>
            <hr class="dropdown-divider">
            <div class="movie-genre w-100 position-relative px-2 mt-5">
                <ul class="movie-genre-slider d-flex list-unstyled">
                    @foreach ($genres as $genre)
                        <li>
                            <button class="w-100 btn btn-pill br-32 background-dark-accent text-light genre-selector" role="button">
                                {{ $genre->name }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-2 row movie-sort">
                <div class="col d-flex align-items-center">
                    <span>Sort By:</span>
                    <button class="mx-2 btn btn-pill br-32 background-dark-accent text-light sort-selector">Latest</button>
                    <button class="mx-2 btn btn-pill br-32 background-dark-accent text-light sort-selector">A-Z</button>
                    <button class="mx-2 btn btn-pill br-32 background-dark-accent text-light sort-selector">Z-A</button>
                </div>
            </div>
        </div>
        <div class="row mt-3 m-1 justify-content-center" id="movie-list-container">
            @include('movies.card')
        </div>
    </div>
    <div hidden id="pager">{{$pages}}</div>
@endsection
