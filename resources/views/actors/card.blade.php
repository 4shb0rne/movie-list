@foreach ($actors as $actor)
    <div class="card background-dark-accent" style="width: 16rem;">
        <img src="{{ asset('storage/actors/'.$actor->image_url) }}" class="actor-image" alt="...">
        <div class="card-body d-flex flex-column justify-content-evenly">
            <h6 class="card-title">{{$actor->name}}</h6>
            @forelse ($actor->movies as $key => $movie)
                @if ($key == 0)
                    <p class="card-text text-muted">{{$movie->title}}</p>
                @endif
            @empty
            @endforelse
        </div>
    </div>
@endforeach
