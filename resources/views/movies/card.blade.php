@forelse ($movies as $movie)
    <div class="col-xl-2 col-5 me-5">
        <a href="{{ route('movie-data', $movie->id) }}">
            <img src="{{ asset('storage/movies/thumbnail/' . $movie->image_url) }}" class="movie-image" alt="...">
        </a>
        <div class="fs-5 py-2">{{ Str::limit($movie->title, 20) }}</div>
        <div class="d-flex justify-content-between">
            <p class="text-muted">{{ $movie->release_date->format('Y') }}</p>
            <p class="card-info">
                @auth
                    @if (!auth()->user()->isAdmin())
                        @can('addWatchList', $movie)
                            <button class="btn p-0" id="addWatchButton" value="{{ $movie->id }}">
                                <i class="fas fa-plus text-muted"></i>
                            </button>
                        @else
                            <button class="btn p-0" id="addWatchButton" value="{{ $movie->id }}">
                                <i class="fas fa-check text-danger"></i>
                            </button>
                        @endcan
                    @endif
                @endauth
            </p>
        </div>
    </div>
@empty
    <div class="row">
        <div class="col-md-4">
            <div class="alert alert-info">
                <p>No Match found</p>
            </div>
        </div>
    </div>
@endforelse
