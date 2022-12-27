@extends('layouts.template', ['title' => 'Edit Movie'])
@section('header')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <script defer>
        const actors = {!! json_encode($actors->toArray(),  JSON_HEX_TAG) !!};
        const genres = {!! json_encode($genres->toArray(),  JSON_HEX_TAG) !!};
        console.log(actors)
        let genreCount = 2;
        let actorCount = 2;
        $(document).ready(function() {

            $('#genre-list-btn').click(function (e) {
                onClickGenre(e)
            });


            $("#actor-list-btn").click(function (e) {
                onClickActor(e)
            });
        });

        function onClickGenre(e) {
            e.preventDefault();
            let id = 'genre-'+genreCount+''
            let html = `<div class="form-floating mb-3"><select class="form-select form-input" id="genre-${id}" name="genres[]" aria-label="Select Genre"><option selected value="-1">Select Genre</option>`
            genres.forEach(genre => {
                html += `<option value="${genre.id}">${genre.name}</option>`
            });

            html+=`</select><label for="genre-${id}">Genres</label></div>`
            $('#genre-container').append(html);
            genreCount++;
        }

        function onClickActor(e) {
            e.preventDefault();
            const id = 'actor-'+actorCount+''
            const charId = 'character-'+actorCount+''
            let html = '<div class="d-flex flex-row mb-3" >'+
                                '<div class="form-floating me-2 w-50">'+
                                    `<select name="actors[]" id="${id}" class="form-select form-input">`+
                                        '<option value="-1" selected>Select an Author</option>'
            actors.forEach(actor => {
                html += '<option value="'+actor.id+'">'+actor.name+'</option>'
            })
            html += '</select>'+
                    `<label for="${id}">Actor</label>`+
                '</div>'+
                '<div class="form-floating w-50">'+
                    `<input type="text" class="form-control form-input" id="${charId}" name="characters[]">`+
                    `<label for="${charId}">Character</label>`+
                '</div>'+
            '</div>'
            e.preventDefault()
            $("#actor-container").append(html);
            actorCount++;
        }
    </script>
@endsection

@section('content')
    <div class="mb-3">
        <div class="d-flex justify-content-center mb-3">

            <form class="form" action="{{ route('validate-edit-movie', ['id'=>$movie->id]) }}}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="d-flex justify-content-start mb-2 fs-3 fw-bold">
                    Edit Movie
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-input @error('title') is-invalid @enderror" id="title"
                        name="title" value="{{old('title', $movie->title)}}">
                    <label for="title">Title</label>
                    @error('title')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description form-label">Description</label>
                    <textarea class="form-control text-area form-input" placeholder="Please leave a description here.." id="description" name="description">"{{old('description', $movie->description)}}"</textarea>
                    @error('description')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="d-flex flex-column" id="genre-container">
                    @forelse ($movie->genres as $g)
                        <div class="form-floating mb-3">
                            <select class="form-select form-input" id="genre-1" name="genres[]" aria-label="Select Genre">
                                <option value="-1">Select Genre</option>
                                @foreach ($genres as $genre)
                                    <option value="{{$genre->id}}" {{$genre->id == $g->id ? 'selected' : ''}}>
                                        {{$genre->name}}
                                    </option>
                                @endforeach
                            </select>
                            <label for="genre-1">Genres</label>
                        </div>
                    @empty
                        <div class="form-floating mb-3">
                            <select class="form-select form-input" id="genre-1" name="genres[]" aria-label="Select Genre">
                                <option selected value="-1">Select Genre</option>
                                @foreach ($genres as $genre)
                                    <option value="{{$genre->id}}">
                                        {{$genre->name}}
                                    </option>
                                @endforeach
                            </select>
                            <label for="genre-1">Genres</label>
                        </div>
                    @endforelse
                    @error('genres')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="d-flex justify-content-end mb-3">
                    <a id="genre-list-btn" class="btn btn-primary">Add Genre</a>
                </div>
                <div class="mb-3">
                    Actors
                    <div class="m-2 d-flex flex-column" id="actor-container">
                        @forelse ($movie->actors as $a)
                            <div class="d-flex flex-row mb-3" >
                                <div class="form-floating me-2 w-50">
                                    <select name="actors[]" id="actor-1" class="form-select form-input">
                                        <option value="-1" >Select an Author</option>
                                        @foreach ($actors as $actor)
                                            <option value="{{$actor->id}}" {{$actor->id == $a->id ? 'selected' : ''}}>
                                                {{$actor->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="actor">Actor</label>
                                </div>
                                <div class="form-floating w-50">
                                    <input type="text" class="form-control form-input" id="character"
                                    name="characters[]" value="{{old('characters[]', $a->pivot->character_name)}}">
                                    <label for="character">Character</label>
                                </div>
                            </div>
                        @empty
                            <div class="d-flex flex-row mb-3" >
                                <div class="form-floating me-2 w-50">
                                    <select name="actors[]" id="actor-1" class="form-select form-input">
                                        <option value="-1" selected>Select an Author</option>
                                        @foreach ($actors as $actor)
                                            <option value="{{$actor->id}}">
                                                {{$actor->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="actor">Actor</label>
                                </div>
                                <div class="form-floating w-50">
                                    <input type="text" class="form-control form-input" id="character"
                                    name="characters[]">
                                    <label for="character">Character</label>
                                </div>
                            </div>
                        @endforelse
                        @error('actor')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end m-2">
                        <a id="actor-list-btn" class="btn btn-primary">Add Actor</a>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-input @error('director') is-invalid @enderror" id="director"
                        name="director" value="{{old('director', $movie->director)}}">
                    <label for="director">Director</label>
                    @error('director')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="date" class="form-control form-input" id="date"
                    name="date" value="{{old('date', $movie->release_date->format('Y-m-d'))}}">
                    <label for="date">Release Date</label>
                    @error('date')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image Url</label>
                    <input type="file" class="form-control form-input" id="image"
                    name="image">
                    @error('image')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="background" class="form-label">Background Url</label>
                    <input type="file" class="form-control form-input" id="background"
                    name="background">
                    @error('background')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-auth w-100">Edit Movie</button>
            </form>
        </div>
    </div>

@endsection
