@extends('layouts.template', ['title' => 'Register'])
@section('header')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection
@section('content')
<div class="mb-5">
    <div class="d-flex justify-content-center mb-3">
        <form class="form" action="{{ route('validate-register') }}" method="POST">
            @csrf
            <div class="d-flex justify-content-center title fs-3 mb-4">
                Hello, Welcome to&nbsp;
                <span class="movie-list ">
                    Movie<span>List</span>
                </span>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-input form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="name@example.com">
                <label for="email">Email address</label>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                @error('email')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-input form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="John Modong">
                <label for="username">Username</label>
                @error('username')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-input form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                <label for="password">Password</label>
                @error('password')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-input form-control @error('password') is-invalid @enderror" id="confirm" name="confirm" placeholder="Password">
                <label for="confirm">Confirm Password</label>
                @error('confirm')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <button type="submit" class="btn btn-auth w-100">Regsister</button>
        </form>
    </div>
    <div class="d-flex justify-content-center">
        @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong class="text-danger">{{ session()->get('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
</div>
@endsection
