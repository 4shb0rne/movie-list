<nav class="navbar navbar-expand-lg background-dark-accent navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand title movie-list" href="/">
            Movie<span>List</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end px-5" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/">Movies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('show-actor') }}">Actors</a>
                </li>
                @auth
                    @if (!auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link active" href="/watchlist">My Watchlists</a>
                        </li>
                    @endif
                    <li class="nav-item dropdown d-flex align-items-center">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-circle-user fs-4"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('view-profile') }}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endauth
                @guest
                    <li class="nav-item mx-2">
                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    </li>

                    <li class="nav-item mx-2">
                        <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
