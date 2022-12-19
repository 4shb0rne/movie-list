<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Cast;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\MovieActor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{

    public function index(Request $request) {
        $movies = Movie::paginate(5);

        $trendingMovies = Movie::get();
        $trendingMovies = $trendingMovies->sortBy(function ($trendSort) {
            return $trendSort->count;
        });
        $trendingMovies = $trendingMovies->reverse();

        $genres = Genre::get();

        $randomMovies = Movie::inRandomOrder()->limit(3)->get();
        $pages = Movie::count() / 5;

        if ($request->ajax() && $request->page) {
            $view = view('movies.data', compact('movies'))->render();
            return response()->json(['html' => $view]);
        } else if ($request->ajax() && $request->genre && !$request->sort) {
            if ($request->search == '') {
                $moviesGenres = Movie::join('movie_genre', 'movies.id', '=', 'movie_genre.movie_id')
                    ->join('genres', 'movie_genre.genre_id', '=', 'genres.id')
                    ->where('genres.name', $request->genre)->get();
                foreach($moviesGenres as $movieGenre){
                    $movieGenre->id = $movieGenre->movie_id;
                }
                $view = view('movies.data', ['movies' => $moviesGenres])->render();
                return response()->json(['html' => $view]);
            } else {
                $movies = Movie::all();
                $moviesGenres = Movie::join('movie_genre', 'movies.id', '=', 'movie_genre.movie_id')
                    ->join('genres', 'movie_genre.genre_id', '=', 'genres.id')
                    ->where('genres.name', $request->genre)
                    ->where('movies.title', 'LIKE', '%' . $request->search . '%')->get();
                $view = view('movies.data', ['movies' => $moviesGenres])->render();
                foreach($moviesGenres as $movieGenre){
                    $movieGenre->id = $movieGenre->movie_id;
                }
                return response()->json(['html' => $view]);
            }
        } else if ($request->ajax() && !$request->genre && $request->sort) {
            if ($request->search == '') {
                $moviesSort = '';
                if ($request->sort == 'Latest') {
                    $moviesSort = Movie::latest('release_date')->get();
                } else if ($request->sort == 'A-Z') {
                    $moviesSort = Movie::select('*')->orderBy('title')->get();
                } else if ($request->sort == 'Z-A') {
                    $moviesSort = Movie::select('*')->orderBy('title', 'desc')->get();
                }
                $view = view('movies.data', ['movies' => $moviesSort])->render();
                return response()->json(['html' => $view]);
            } else {
                $moviesSort = '';
                if ($request->sort == 'Latest') {
                    $moviesSort = Movie::latest('release_date')
                        ->where('movies.title', 'LIKE', '%' . $request->search . '%')->get();
                } else if ($request->sort == 'A-Z') {
                    $moviesSort = Movie::select('*')->orderBy('title')
                        ->where('movies.title', 'LIKE', '%' . $request->search . '%')->get();
                } else if ($request->sort == 'Z-A') {
                    $moviesSort = Movie::select('*')->orderBy('title', 'desc')
                        ->where('movies.title', 'LIKE', '%' . $request->search . '%')->get();
                }
                $view = view('movies.data', ['movies' => $moviesSort])->render();
                return response()->json(['html' => $view]);
            }
        } else if ($request->ajax() && $request->genre && $request->sort) {
            if ($request->search == '') {
                $moviesMix = Movie::join('movie_genre', 'movies.id', '=', 'movie_genre.movie_id')
                    ->join('genres', 'movie_genre.genre_id', '=', 'genres.id')
                    ->where('genres.name', $request->genre);
                if ($request->sort == 'Latest') {
                    $moviesMix = $moviesMix->orderBy('release_date', 'desc')->get();
                } else if ($request->sort == 'A-Z') {
                    $moviesMix = $moviesMix->orderBy('title')->get();
                } else if ($request->sort == 'Z-A') {
                    $moviesMix = $moviesMix->orderBy('title', 'desc')->get();
                }
                $view = view('movies.data', ['movies' => $moviesMix])->render();
                return response()->json(['html' => $view]);
            } else {
                $moviesMix = Movie::join('movie_genre', 'movies.id', '=', 'movie_genre.movie_id')
                    ->join('genres', 'movie_genre.genre_id', '=', 'genres.id')
                    ->where('genres.name', $request->genre)
                    ->where('movies.title', 'LIKE', '%' . $request->search . '%');
                if ($request->sort == 'Latest') {
                    $moviesMix = $moviesMix->orderBy('release_date', 'desc')->get();
                } else if ($request->sort == 'A-Z') {
                    $moviesMix = $moviesMix->orderBy('title')->get();
                } else if ($request->sort == 'Z-A') {
                    $moviesMix = $moviesMix->orderBy('title', 'desc')->get();
                }
                $view = view('movies.data', ['movies' => $moviesMix])->render();
                return response()->json(['html' => $view]);
            }
        } else if ($request->ajax() && !$request->genre && !$request->sort) {
            if ($request->search == '') {
                $moviesGenres = Movie::get();
                $view = view('movies.data', ['movies' => $moviesGenres])->render();
                return response()->json(['html' => $view]);
            } else {
                $moviesGenres = Movie::where('movies.title', 'LIKE', '%' . $request->search . '%')->get();
                $view = view('movies.data', ['movies' => $moviesGenres])->render();
                return response()->json(['html' => $view]);
            }
        }

        return view('movies.home', compact('movies', 'trendingMovies', 'genres', 'randomMovies', 'pages'));
    }

    public function movie(Movie $movie)
    {
        $genres = DB::table('movie_genre')
            ->join('genres', 'movie_genre.genre_id', '=', 'genres.id')
            ->where('movie_id', $movie->id)->get();


        $actors = DB::table('movies')
            ->join('movie_actors', 'movies.id', '=', 'movie_actors.movie_id')
            ->join('actors', 'movie_actors.actor_id', '=', 'actors.id')
            ->where('movies.id', $movie->id)->get();
        $movies = Movie::get();


        return view('movies.detail', compact('movie', 'actors', 'genres', 'movies'));
    }

    public function create()
    {
        $this->authorize('addMovie');
        $movie = new Movie();
        $genres = Genre::get();
        $actors = Actor::get();
        return view('movies.create', compact('movie', 'genres', 'actors'));
    }

    public function store(Request $request)
    {
        $this->authorize('addMovie');

        $attr = $request->validate([
            'title' => 'required|min:2|max:50',
            'description' => 'required|min:8',
            'genres' => 'array|required',
            'actors' => 'array|required',
            'characters' => 'array|required',
            'director' => 'required|min:3',
            'release_date' => 'required',
            'image_url' => 'required',
            'bg_url' => 'required'
        ]);

        if ($request->file('image_url')) {
            $file = $request->file('image_url');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('storage/movies/thumbnail'), $filename);
            $attr['image_url'] = $filename;
        }

        if ($request->file('bg_url')) {
            $file = $request->file('bg_url');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('storage/movies/bg-image'), $filename);
            $attr['bg_url'] = $filename;
        }

        $characters = $request->characters;
        $actors = $request->actors;
        $movie = Movie::create($attr);

        for ($i = 0; $i < count($characters); $i++) {
            MovieActor::create(['character_name' => $characters[$i], 'movie_id' => $movie->id, 'actor_id' => $actors[$i]]);
        }

        $movie->genres()->attach(request('genres'));
        return redirect('/')->with('success-info', 'Add Movie Successfully');
    }

    public function edit(Movie $movie)
    {
        $this->authorize('editMovie');

        $genres = Genre::get();
        $actors = Actor::get();
        return view('movies.edit', compact('movie', 'genres', 'actors'));
    }

    public function update(Request $request, Movie $movie)
    {
        $this->authorize('editMovie');

        $attr = $request->validate([
            'title' => 'required|min:2|max:50',
            'description' => 'required|min:8',
            'genres' => 'array|required',
            'actors' => 'array|required',
            'characters' => 'array|required',
            'director' => 'required|min:3',
            'release_date' => 'required',
            'image_url' => 'required|mimes:jpeg,jpg,png,gif',
            'bg_url' => 'required|mimes:jpeg,jpg,png,gif'
        ]);

        if ($request->file('image_url')) {
            if ($movie->image_url) {
                Storage::delete('public/movies/thumbnail/' . $movie->image_url);
            }
            $file = $request->file('image_url');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('storage/movies/thumbnail'), $filename);
            $attr['image_url'] = $filename;
        }

        if ($request->file('bg_url')) {
            if ($movie->bg_url) {
                Storage::delete('public/movies/bg-image/' . $movie->bg_url);
            }
            $file = $request->file('bg_url');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('storage/movies/bg-image'), $filename);
            $attr['bg_url'] = $filename;
        }

        $characters = $request->characters;
        $actors = $request->actors;
        $movie->update($attr);

        MovieActor::where('movie_id', $movie->id)->delete();

        for ($i = 0; $i < count($request->characters); $i++) {
            MovieActor::create(['character_name' => $characters[$i], 'movie_id' => $movie->id, 'actor_id' => $actors[$i]]);
        }
        $movie->genres()->sync(request('genres'));

        return redirect('/movie/' . $movie->id)->with('success-info', 'Update Movie Successfully');
    }

    public function destroy(Movie $movie)
    {
        $this->authorize('editMovie');

        Storage::delete('public/movies/thumbnail/' . $movie->image_url);
        Storage::delete('public/movies/bg-image/' . $movie->bg_url);

        MovieActor::where('movie_id', $movie->id)->delete();
        $movie->genres()->detach();
        $movie->delete();
        return redirect('/')->with('success-info', 'Delete Movie Successfully');
    }
}
