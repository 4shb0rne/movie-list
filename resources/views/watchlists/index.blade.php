@extends('layouts.template', ['title' => 'Watchlists'])
@section('header')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/watchlist.css') }}">
    <script src="{{ asset('js/watchlist.js') }}" defer></script>
@endsection
@section('content')
    <div class="d-flex flex-column w-100 justify-content-between py-3 px-5" style="min-height: 50vh">
        <div>
            <div>
                <h3 class="fw-bold">My <span class="color-red">Watchlists</span></h3>
            </div>
            <div class="mb-3">
                <input type="text" class="form-input form-control w-100 text-light py-2" name="search"
                    id="search-watchlist" placeholder="Search something...">
            </div>
            <div class="d-flex flex-row align-items-center mb-3">
                <i class="fa-solid fa-filter fs-4 me-2"></i>
                <select name="filter" class="form-select form-input" style="width: auto" id="filter">
                    <option value="All">All</option>
                    <option value="Planning">Planning</option>
                    <option value="Watching">Watching</option>
                    <option value="Finished">Finished</option>
                </select>
            </div>
            <div class="d-flex flex-column px-1">
                <div class="row mb-3">
                    <div class="col-3">Poster</div>
                    <div class="col-4">Title</div>
                    <div class="col-3">Status</div>
                    <div class="col-2">Action</div>
                </div>
                <div id="watchlist-container">
                    @include("watchlists.card")
                </div>
            </div>
        </div>
        <nav aria-label="Page navigation example" class="mt-1">
            <ul class="pagination justify-content-end align-items-end mx-2">
                <li class="page-item">
                    <a class="page-link" href="{{ $watchlists->previousPageUrl() }}">Prev</a>
                </li>
                @for ($i = 1; $i <= $watchlists->lastPage(); $i++)
                    @if ($i == $watchlists->currentPage())
                        <li class="page-item active" aria-current="page">
                            <a class="page-link" href="#">{{ $i }}</a>
                        </li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $watchlists->url($i) }}">{{ $i }}</a>
                        </li>
                    @endif
                @endfor
                <li class="page-item">
                    <a class="page-link" href="{{ $watchlists->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
@endsection
