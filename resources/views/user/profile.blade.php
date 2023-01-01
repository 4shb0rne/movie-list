@extends('layouts.template', ['title' => 'Profile'])
@section('header')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection
@section('content')
    <div class="d-flex flex-row w-100 justify-content-center p-5">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <span class="fs-3 fw-bold mb-3">
                My <span class="color-red">Profile</span>
            </span>
            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background: none;">
                @if ($user->image_url)
                    <img src="{{$user->image_url}}" alt="Load error.." class="user-profile-image">
                @else
                    <i class="fa-solid fa-circle-user mb-3" style="font-size: 5rem;"></i>
                @endif
            </button>
            <span class="fw-bold mb-3">
                {{ $user->name }}
            </span>
            <span class="fw-bold text-muted mb-3">
                {{ $user->email }}
            </span>
        </div>
        <div class="d-flex flex-column px-5 w-50">
            <h3 class="mb-3 color-red">
                Update Profile
            </h3>
            <form action="{{ route('validate-edit-profile') }}" method="POST">
                @csrf
                @method('put')
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-input @error('name') is-invalid @enderror" id="name"
                        name="name" placeholder="Username" value="{{ old('name', $user->name) }}">
                    <label for="name">Username</label>
                    @error('name')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control form-input @error('email') is-invalid @enderror"
                        id="email" name="email" placeholder="email" value="{{ old('email', $user->email) }}">
                    <label for="email">Email</label>
                    @error('email')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="date" class="form-control form-input @error('dob') is-invalid @enderror" id="dob"
                        name="dob" placeholder="dob" value="{{ old('dob', $user->dob) }}">
                    <label for="dob">DoB</label>
                    @error('dob')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-input @error('phone') is-invalid @enderror"
                        id="phone" name="phone" placeholder="phone" value="{{ old('phone', $user->phone) }}">
                    <label for="phone">Phone</label>
                    @error('phone')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                {{-- MODAL --}}
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content modal-background">
                            <div class="modal-header"  style="border: none;">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Image</h1>
                                <button type="button" class="btn-close text-light" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-floating">
                                    <input type="text" class="form-control form-input background-dark @error('image_url') is-invalid @enderror" id="image_url" name="image_url" placeholder="image_url" value="{{ old('image_url', $user->image_url) }}">
                                    <label for="image_url">Profile Image</label>
                                    <div class="form-text">Please upload your image to other sources first and use the URL.</div>
                                    @error('image_url')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer"  style="border: none;">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-auth fw-bold">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-auth w-100 fw-bold">Save Changes</button>
            </form>
        </div>
    </div>
@endsection
