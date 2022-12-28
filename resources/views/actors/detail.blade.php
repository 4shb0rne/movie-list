@extends('layouts.template', ['title' => $actor->name])
@section('header')
    <link rel="stylesheet" href="{{ asset('css/actor.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="my-3 mx-5 d-flex justify-content-center row">
            <div class="col-4 mx-3 d-flex justify-content-end">
                <div class="actor-detail-image" style="
                    background: url({{ asset('storage/actors/'.$actor->image_url) }})
                        , no-repeat;
                    background-size: cover;
                    background-position: center;
                ">
                </div>
            </div>
            <div class="col-6">
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
                        @foreach ($actor->movies as $m)
                            <a href="{{ route('movie-detail', $m->id) }}">
                                <div class="card movie-card bg-dark" style="width: 14rem;">
                                    <img src="{{ asset('storage/movies/thumbnail/'.$m->image_url) }}" class="movie-image" alt="...">
                                    <div class="card-body movie-card d-flex flex-column justify-content-between">
                                        <p class="card-title fs-6">{{$m->title}}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
