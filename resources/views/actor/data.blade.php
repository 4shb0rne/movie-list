@forelse ($actors as $actor)
    <div class="col">
        <div class="card">
            <div class="card-image">
                <a href="{{ route('show-actor-detail', $actor->id) }}" class="w-100 h-100">
                    <img src="{{ asset('storage/actors/' . $actor->image_url) }}" class="card-img-top" alt="...">
                </a>
            </div>
            <div class="card-body">
                <h5 class="card-title text-light">{{ $actor->name }}</h5>
                <p class="card-text text-muted"> {{ $actor->movie_name }}</p>
            </div>
        </div>
    </div>
@empty
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="alert alert-info">
                <p>No Match found</p>
            </div>
        </div>
    </div>
@endforelse
