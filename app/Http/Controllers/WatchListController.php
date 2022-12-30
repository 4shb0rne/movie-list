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
        if ($request->ajax() && !$request->filter) {
            if ($request->search == '') {
                $watchlists = Movie::join('watchlists', 'movies.id', '=', 'watchlists.movie_id')->where('watchlists.user_id', $user->id)
                    ->get();
                $view = view('watchlists.data', compact('watchlists'))->render();
                return response()->json(['html' => $view]);
            } else {
                $watchlists = Movie::join('watchlists', 'movies.id', '=', 'watchlists.movie_id')->where('watchlists.user_id', $user->id)
                    ->where('movies.title', 'LIKE', '%' . $request->search . '%')->get();
                $view = view('watchlists.data', compact('watchlists'))->render();
                return response()->json(['html' => $view]);
            }
        } else if ($request->ajax() && $request->filter) {
            if ($request->search == '') {
                if ($request->filter != 'all') {
                    $watchlists = Movie::join('watchlists', 'movies.id', '=', 'watchlists.movie_id')->where('watchlists.user_id', $user->id)->where('watchlists.status', $request->filter)
                        ->get();
                    $view = view('watchlists.data', compact('watchlists'))->render();
                    return response()->json(['html' => $view]);
                } else if ($request->filter == 'all') {
                    $watchlists = Movie::join('watchlists', 'movies.id', '=', 'watchlists.movie_id')->where('watchlists.user_id', $user->id)->get();
                    $view = view('watchlists.data', compact('watchlists'))->render();
                    return response()->json(['html' => $view]);
                }
            } else {
                if ($request->filter == 'all') {
                    $watchlists = Movie::join('watchlists', 'movies.id', '=', 'watchlists.movie_id')->where('watchlists.user_id', $user->id)->where('movies.title', 'LIKE', '%' . $request->search . '%')->get();
                    $view = view('watchlists.data', compact('watchlists'))->render();
                    return response()->json(['html' => $view]);
                } else {
                    $watchlists = Movie::join('watchlists', 'movies.id', '=', 'watchlists.movie_id')->where('watchlists.user_id', $user->id)->where('movies.title', 'LIKE', '%' . $request->search . '%')->where('watchlists.status', $request->filter)
                        ->get();
                    $view = view('watchlists.data', compact('watchlists'))->render();
                    return response()->json(['html' => $view]);
                }
            }
        }

        $watchlists = Movie::join('watchlists', 'movies.id', '=', 'watchlists.movie_id')->where('watchlists.user_id', $user->id)->paginate(4);
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
        $this->authorize('updateWatchList', $movie);
        $user = Auth::user();
        if ($request->status == 'planning' || $request->status == 'finished' || $request->status == 'watching') {
            DB::table('watchlists')->where('user_id', $user->id)->where('movie_id', $movie->id)->update([
                'status' => ucfirst($request->status)
            ]);
        } else if ($request->status == 'remove') {
            $watchlist = Watchlist::where('user_id', $user->id)->where('movie_id', $movie->id)->delete();
        }

        return redirect('/watchlist?page=' . $request->page)->with('success-info', 'Watchlist has been updated');
    }
}
