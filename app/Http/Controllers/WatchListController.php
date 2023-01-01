<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use App\Models\Watchlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WatchListController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $watchlists = Movie::join('watchlists', 'movies.id', '=', 'watchlists.movie_id')
            ->where('watchlists.user_id', $user->id)
            ->paginate(4);

        if ($request->ajax()) {
            $filter = $request->filter;
            $search = $request->search;
            $watchlists = Movie::join('watchlists', 'movies.id', '=', 'watchlists.movie_id')
                ->where('watchlists.user_id', $user->id);
            if ($search && $search != "") {
                $watchlists = $watchlists->where('movies.title', 'LIKE', '%' . $request->search . '%');
            }

            if ($filter && $filter != "All") {
                $watchlists = $watchlists
                    ->where('watchlists.status', 'LIKE', '%' . $request->search . '%')
                    ->where('watchlists.status', $request->filter);
            }
            $watchlists = $watchlists->paginate(4);
            $view = view('watchlists.card', compact('watchlists'))->render();
            return response()->json(['view' => $view]);
        }
        return view('watchlists.index', compact('watchlists'));
    }

    public function modify(Request $request, $id) {
        if ($request->ajax()) {
            $movie = Movie::find($id);
            $user = Auth::user();
            $wl = Watchlist::query()
                    ->where('movie_id',$movie->id)
                    ->where('user_id',$user->id)
                    ->first();
            if ($wl) {
                $this->destroy($user, $movie);
                return response()->json(['message' => "Deleted", 'isAdd' => false]);
            } else {
                $this->add($user, $movie);
                return response()->json(['message' => "Added", 'isAdd' => true]);
            }
        }
    }

    private function add(User $user, Movie $movie)
    {
        Watchlist::create([
            'movie_id' => $movie->id,
            'user_id' => $user->id,
            'status' => 'Planning'
        ]);
    }

    private function destroy(User $user, Movie $movie)
    {
        $this->authorize('updateWatchList', $movie);
        Watchlist::where('user_id', $user->id)->where('movie_id', $movie->id)->delete();
    }

    public function action(Request $request, Movie $movie)
    {
        if ($request->status != "Remove" && $request->status != "Planning" && $request->status != "Watching" && $request->status != "Finished") {
            return redirect('/watchlist?page=' . $request->page);
        };

        $user = Auth::user();
        $watchlist = Watchlist::where('user_id', $user->id)->where('movie_id', $movie->id);
        $this->authorize('updateWatchList', $movie);

        if ($request->status == "Remove") {
            $watchlist->delete();
        } else if ($request->status != $watchlist->first()->status) {
            $watchlist->update(['status' => $request->status]);
        }
        return redirect('/watchlist?page=' . $request->page);
    }
}
