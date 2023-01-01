<?php

namespace App\Policies;

use App\Models\{User, Movie};
use Illuminate\Auth\Access\HandlesAuthorization;

class MoviePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */

    public function createMovie(User $user)
    {
        return $user->isAdmin();
    }

    public function createActor(User $user)
    {
        return $user->isAdmin();
    }

    public function editMovie(User $user)
    {
        return $user->isAdmin();
    }

    public function addWatchList(User $user, Movie $movie)
    {
        $count = Movie::join('watchlists', 'movies.id', '=', 'watchlists.movie_id')
            ->where('movies.id', '=', $movie->id)
            ->where('user_id', '=', $user->id)
            ->count();
        return $count <= 0;
    }

    public function updateWatchList(User $user, Movie $movie)
    {
        $count = Movie::join('watchlists', 'movies.id', '=', 'watchlists.movie_id')
            ->where('movies.id', '=', $movie->id)
            ->where('user_id', '=', $user->id)
            ->count();

        return $count == 1;
    }
}
