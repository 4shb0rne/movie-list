@extends('layouts.template', ['title' => 'Actors'])
@section('header')
    <link rel="stylesheet" href="{{ asset('css/actor.css') }}">
    <script defer>
        var currPage = 1;
        var searchQuery = ""
        $(document).ready(function() {
            const actorContainer = $("#actor-container")
            const search = $('#search-actor')

            $(window).scroll(function() {
                const currScroll = $(window).scrollTop() + $(window).height() + 1;
                if (currScroll >= $(document).height() && {{ $pages }} > currPage && searchQuery == "") {
                    currPage++
                    loadActors(currPage)
                }

            });

            const loadActors = (page) => {
                $.ajax({
                        url: "?page=" + page,
                        type: "get",
                    })
                    .done(function(data) {
                        if (data.html == " " || !data.html) {
                            return;
                        }
                        actorContainer.append(data.html);
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError) {
                        console.log(jqXHR)
                        console.log(ajaxOptions)
                        alert(thrownError)
                    });
            }

            search.keyup(function(e) {
                if (e.keyCode == 13) {
                    searchQuery = $(this).val();
                    actorContainer.empty()
                    loadActorQuery()
                }
            });

            const loadActorQuery = () => {
                const query = (!searchQuery || searchQuery == "" ? "" : searchQuery.trim())

                $.ajax({
                    url: '?search=' + query,
                    type: "get",
                })
                .done(function(data) {
                    if (data.html == " " || !data.html) {
                        return;
                    }
                    console.log(data.html)
                    actorContainer.empty()
                    actorContainer.append(data.html)
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    console.log(jqXHR)
                    console.log(ajaxOptions)
                    alert(thrownError)
                });
            }
        });
    </script>
@endsection
@section('content')
    <div class="m-3">
        <div class="px-5 w-100 d-flex justify-content-center">
            <div class="d-flex justify-content-between w-100">
                <div>
                    <h3 class="color-red fw-bold">Actors</h3>
                </div>
                <div class="d-flex justify-content-evenly">
                    <input type="text" class="actor-search py-2 px-3 text-light" id="search-actor"
                        placeholder="Search actors...">
                    @auth
                        @if (auth()->user()->isAdmin())
                            <a class="ms-2 btn btn-danger" href="{{ route('add-actor') }}">Add Actor</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
        <div class="px-5 mt-3">
            <div class="d-flex flex-wrap justify-content-center" id="actor-container">
                @include('actors.card')
            </div>
        </div>
    </div>
@endsection
