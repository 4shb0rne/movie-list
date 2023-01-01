@extends('layouts.template', ['title' => $actor->name])
@section('header')
    <link rel="stylesheet" href="{{ asset('css/actor.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="my-3 mx-5 d-flex flex-row justify-content-center">
            <div class="mx-3 d-flex flex-column">
                <div class="actor-detail-image" style="
                    background: url({{ asset('storage/actors/'.$actor->image_url) }})
                        , no-repeat;
                    background-size: cover;
                    background-position: center;
                ">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <div class="d-flex flex-column p-1">
                                <div>
                                    <a href="{{ route('edit-actor', ['actor'=>$actor->id]) }}">
                                        <i class="fa-solid fa-pen-to-square me-2 fs-5 background-red circle-icon"></i>
                                    </a>
                                </div>
                                <form action="{{ route('delete-actor', ['actor'=>$actor->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        style="background: none;
                                        padding: 0;
                                        border:none"
                                    >
                                        <i class="fa-solid fa-trash fs-5 background-red circle-icon"></i>
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
                <div class="d-flex flex-column align-items-start">
                    <p class="fs-3 fw-bold mb-1">Personal Info</p>
                    <span class="fs-5 mb-1">Popularity</span>
                    <span class="text-muted mb-1">{{$actor->popularity}}</span>
                    <span class="fs-5 mb-1">Gender</span>
                    <span class="text-muted mb-1">{{$actor->gender}}</span>
                    <span class="fs-5 mb-1">Birthday</span>
                    <span class="text-muted mb-1">{{$actor->dob}}</span>
                    <span class="fs-5 mb-1">Place of Birth</span>
                    <span class="text-muted mb-1">{{$actor->place_of_birth}}</span>
                </div>
            </div>
            <div class="w-50 d-flex flex-column">
                <div>
                    <h2>{{$actor->name}}</h2>
                    <h4 class="fw-normal">Biography</h4>
                    <div class="fw-light">
                        {{$actor->biography}}
                    </div>
                </div>
                <div class="mt-3">
                    <h4 class="fw-normal">Known For</h4>
                    <div class="d-flex flex-wrap">
                        @forelse ($actor->movies as $m)
                            <a href="{{ route('movie-detail', $m->id) }}">
                                <div class="card movie-card bg-dark" style="width: 14rem;">
                                    <img src="{{ asset('storage/movies/thumbnail/'.$m->image_url) }}" class="movie-image" alt="...">
                                    <div class="card-body movie-card d-flex flex-column justify-content-between">
                                        <p class="card-title fs-6">{{$m->title}}</p>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <p class="fs-6">No Movies yet ...</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
