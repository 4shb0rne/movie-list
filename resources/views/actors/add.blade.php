@extends('layouts.template', ['title' => 'Actors'])
@section('header')
    <link rel="stylesheet" href="{{ asset('css/actor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection
@section('content')
<div class="mb-3">
    <div class="d-flex justify-content-center mb-3">
        <form class="form" action="{{ route('validate-add-actor') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="d-flex justify-content-start mb-2 fs-3 fw-bold">
                Add Movie
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control form-input @error('name') is-invalid @enderror" id="name"
                    name="name" placeholder="name@example.com">
                <label for="name">Name</label>
                @error('name')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="d-flex flex-column" id="genre-container">
                <div class="form-floating mb-3">
                    <select class="form-select form-input" id="gender" name="gender" aria-label="Select Gender">
                        <option selected value="-1">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <label for="gender">Gender</label>
                </div>
                @error('genres')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="biography form-label">Biography</label>
                <textarea class="form-control text-area form-input" placeholder="Please leave a biography here.." id="biography"
                    name="biography"></textarea>
                @error('biography')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="date" class="form-control form-input" id="dob"
                name="dob">
                <label for="dob">Date of Birth</label>
                @error('dob')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control form-input @error('place_of_birth') is-invalid @enderror" id="place_of_birth"
                    name="place_of_birth">
                <label for="place_of_birth">Place of Birth</label>
                @error('place_of_birth')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image_url" class="form-label">Image Url</label>
                <input type="file" class="form-control form-input" id="image_url"
                name="image_url">
                @error('image_url')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="popularity" class="form-label">Popularity</label>
                <input type="text" class="form-control form-input" id="popularity"
                name="popularity">
                @error('popularity')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <button type="submit" class="btn btn-auth w-100">Add Actor</button>
        </form>
    </div>
</div>
@endsection
