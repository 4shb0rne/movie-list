<?php

namespace App\Policies;

use App\Models\{User, Movie, Review};
use Illuminate\Auth\Access\HandlesAuthorization;

class MoviePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */

    public function addMovie(User $user)
    {
        return ($user->isAdmin());
    }

    public function addActor(User $user)
    {
        return ($user->isAdmin());
    }

    public function addWatchList(User $user, Movie $movie)
    {
        $count = Movie::join('watchlists', 'shows.id', '=', 'watchlists.show_id')->where('shows.id', '=', $movie->id)
            ->where('user_id', '=', $user->id)->count();
        if ($count == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function actionWatchList(User $user, Movie $movie)
    {
        $count = Movie::join('watchlists', 'shows.id', '=', 'watchlists.show_id')->where('shows.id', '=', $movie->id)
            ->where('user_id', '=', $user->id)->count();
        if ($count == 1) {
            return true;
        } else {
            return false;
        }
    }
}
