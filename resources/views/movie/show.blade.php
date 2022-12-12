@extends('layouts.app', ['title' => $movie->title])
@section('library')
    <link rel="stylesheet" href="{{ asset('css/movie.css') }}">
    <script src="{{ asset('js/lightslider.js') }}"></script>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/lightslider.css') }}" />
    <script src="{{ asset('js/movie.js') }}" defer></script>
@endsection
@section('content')
    <section class='main-class container-fluid'>
        <div class="bg-image"
            style='background-image: url({{ asset('storage/movies/bg-image/' . $movie->bg_url) }});'>
            <div class="row show-detail" id='show-detail'>
                <div class='col'>
                    <img src="{{ asset('storage/movies/thumbnail/' . $movie->image_url) }}" class='show-image'>
                </div>
                <div class='col-lg-8 text-light container'>
                    <div class='show-title d-flex roboto'>
                        <h1 class="w-75">{{ $movie->title }}</h1>
                        @auth
                            @if (!auth()->user()->isAdmin())
                                @can('addWatchList', $movie)
                                    <div class="d-flex w-50">
                                        <button class='btn btn-danger top-addbtn'>+ Add to Watchlist</button>
                                    </div>
                                @endcan
                            @else
                                @can('editMovie')
                                    <div class="d-flex me-2">
                                        <a href="{{ route('edit-movie', $movie->id) }}" class="btn p-2 fs-3 text-light">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <form action="{{ route('delete-movie', $movie->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn p-2 fs-3 text-light"><i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endcan
                            @endif
                        @endauth
                    </div>
                    <div class='d-flex poppins'>
                        @foreach ($genres as $genre)
                            <button href='#' class="genre">{{ $genre->name }}</button>
                        @endforeach
                    </div>
                    <div class='d-flex show-info poppins'>
                        <div>
                            <div class='show-info-score'>{{ $movie->rating }}</div>
                        </div>
                        <div>
                            <div><i class="far fa-calendar-alt text-primary"></i></div>
                            <div class='show-info-tag'>Release Year</div>
                            <div class='show-info-score'>{{ $movie->release_date->format('Y') }}</div>
                        </div>
                    </div>
                    <div class='show-description roboto'>
                        <h4>Storyline</h4>
                        <p>{{ $movie->description }}</p>
                        <h4>{{ $movie->director }}</h4>
                        <p>Director</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="show-detail text-light" id='cast'>
            <h2 class='section-title mb-5'>Cast</h2>
            <div class="card-group cast-carousel cs-hidden text-light" id="autoWidth2">
                @forelse ($actors as $actor)
                    <div class="cast-card card">
                        <a href="{{ route('show-actor-detail', $actor->actor_id) }}">
                            <img src="/storage/actors/{{ $actor->image_url }}" class="cast-image w-100">
                        </a>
                        <div class="card-body p-3">
                            <h5 class="card-title">{{ $actor->name }}</h5>
                            <p class="card-text">{{ $actor->character_name }}</p>
                        </div>
                    </div>
                @empty
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <p>There is No Casts</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        <section class='container p-3 text-light'>
            <h2 class='section-title mb-5'>More</h2>
            <ul class="movie-carousel card-group list-unstyled cs-hidden text-light" id="autoWidth">
                @foreach ($movies as $currMovie)
                    @if ($currMovie != $movie)
                        <li class="card movie-card">
                            <a href="{{ route('show-movie', $currMovie->id) }}"><img
                                    src="{{ asset('storage/movies/thumbnail/' . $currMovie->image_url) }}"
                                    class="card-img-top" alt="..."></a>
                            <div class="card-body">
                                <h5 class="card-title">{{ Str::limit($currMovie->title, 20) }}</h5>
                                <div class="d-flex justify-content-between">
                                    <p class="text-muted">{{ $currMovie->release_date->format('Y') }}</p>
                                    <p class="card-info">
                                        @auth
                                            @if (!auth()->user()->isAdmin())
                                                @can('addWatchList', $currMovie)
                                                    <button class="btn p-0 addBtn" id="addWatchButton"
                                                        value="{{ $currMovie->id }}">
                                                        <i class="fas fa-plus text-muted"></i>
                                                    </button>
                                                @else
                                                    <button class="btn p-0 addBtn added" id="addWatchButton"
                                                        value="{{ $currMovie->id }}">
                                                        <i class="fas fa-check text-danger"></i>
                                                    </button>
                                                @endcan
                                            @endif
                                        @endauth
                                    </p>
                                </div>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        </section>
        <script>
            const addMovies = $('.addBtn');
            addMovies.each(function() {
                $(this).on('click', function() {
                    var movie_id = $(this).val();
                    console.log(movie_id);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    if ($(this).hasClass('added')) {
                        $.ajax({
                            url: "/api/addWatchlist/" + movie_id,
                            type: "DELETE",
                            contentType: false,
                            processData: false,
                            success: (data) => {
                                $(this).html('<i class="fas fa-plus text-muted"></i>');
                                $(this).removeClass('added');
                                $.notify("Removed from watchlist", "warn");
                            },
                            error: (data) => {
                                console.log(data.responseJSON);
                            },
                        });
                    } else {
                        $.ajax({
                            url: "/api/addWatchlist/" + movie_id,
                            type: "POST",
                            contentType: false,
                            processData: false,
                            success: (data) => {
                                $(this).html('<i class="fas fa-check text-danger"></i>');
                                $(this).addClass('added');
                                $.notify("Added to watchlist", "success");
                            },
                            error: (data) => {
                                console.log(data.responseJSON);
                            },
                        });
                    }
                })
            });

            const topButton = document.querySelector('.top-addbtn');
            if (topButton) {
                topButton.addEventListener('click', () => {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "/api/addWatchlist/{{ $movie->id }}",
                        type: "POST",
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            topButton.remove();
                            $.notify("Added to watchlist", "success");
                        },
                        error: (data) => {
                            console.log(data.responseJSON);
                        },
                    });
                });
            }
        </script>
    @endsection
