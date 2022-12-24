@extends('layouts.template', ['title' => 'Add Movie'])
@section('header')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection
@section('content')
    <div class="mb-5">
        <div class="d-flex justify-content-center mb-3">
            <form class="form" action="" method="POST">
                @csrf
                <div class="d-flex justify-content-start mb-2 fs-3 fw-bold">
                    Add Movie
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" placeholder="name@example.com">
                    <label for="title">Title</label>
                    @error('title')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description form-label">Description</label>
                    <textarea class="form-control text-area" placeholder="Please leave a description here.." id="description"
                        name="description"></textarea>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="genre" name="genre" aria-label="Select Genre">
                        <option selected value="-1">Select Genre</option>
                        @foreach ($genres as $genre)
                            <option value="{{$genre->id}}">{{$genre->name}}</option>
                        @endforeach
                    </select>
                    <label for="genre">Genres</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('director') is-invalid @enderror" id="director"
                        name="director" placeholder="name@example.com">
                    <label for="director">Director</label>
                    @error('director')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-auth w-100">Add Movie</button>
            </form>
        </div>
    </div>
@endsection
