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
        $pages = ceil(Movie::count() / 5);

        if ($request->ajax() && $request->page) {
            $view = view('movies.card', compact('movies'))->render();
            return response()->json(['html' => $view]);

        } else if ($request->ajax()) {
            $genre = $request->genre;
            $sort = $request->sort;
            $search = $request->search;
            $movies = Movie::select('*');

            if ($genre != "-1") {
                $filtered = Movie::join('movie_genres', 'movies.id', '=', 'movie_genres.movie_id')
                            ->join('genres', 'movie_genres.genre_id', '=', 'genres.id')
                            ->where('genres.name', $genre);
            } else {
                $filtered = $movies;
            }

            if ($sort != "-1" ) {
                $indicator = "";
                $order = "asc";
                if ($sort == "Latest") {
                    $indicator = 'release_date';
                    $order = "desc";
                } else if ($sort == "A-Z") {
                    $indicator = 'title';
                } else if ($sort == "Z-A") {
                    $indicator = 'title';
                    $order = "desc";
                }

                $sorted = $filtered->orderBy($indicator, $order);
            } else {
                $sorted = $filtered;
            }

            if ($search != "-1") {
                $searchedMovies = $sorted->where('movies.title', 'LIKE', '%' . $request->search . '%');
            } else {
                $searchedMovies = $sorted;
            }

            $view = view('movies.card', ['movies' => $searchedMovies->get()])->render();
            return response()->json(['html' => $view]);
        }
        return view('movies.home', compact('movies', 'trendingMovies', 'genres', 'randomMovies', 'pages'));
    }


    public function detail($id)
    {
        $genres = DB::table('movie_genres')
            ->join('genres', 'movie_genres.genre_id', '=', 'genres.id')
            ->where('movie_id', $id)
            ->get();

        $actors = DB::table('movies')
            ->join('movie_actors', 'movies.id', '=', 'movie_actors.movie_id')
            ->join('actors', 'movie_actors.actor_id', '=', 'actors.id')
            ->where('movies.id', $id)
            ->get();

        $more = DB::table('movies')->where('movies.id','<>',$id)->get();

        $movie = Movie::where('id',$id)->first();
        return view('movies.detail', compact('movie', 'actors', 'genres', 'more'));
    }

    public function create()
    {
        $this->authorize('createMovie');
        $genres = Genre::all();
        $actors = Actor::all();
        return view('movies.add', compact('genres', 'actors'));
    }

    public function validateCreate(Request $request)
    {
        $this->authorize('createMovie');

        $attr = $request->validate([
            'title' => 'required|min:2|max:50|unique:movies',
            'description' => 'required|min:8',
            'genres' => 'array|required',
            'actors' => 'array|required',
            'characters' => 'array|required',
            'director' => 'required|min:3',
            'date' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,gif',
            'background' => 'required|mimes:jpg,jpeg,png,gif'
        ]);

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('storage/movies/thumbnail'), $filename);
            $attr['image_url'] = $filename;
        }

        if ($request->file('background')) {
            $file = $request->file('background');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('storage/movies/bg-image'), $filename);
            $attr['background_url'] = $filename;
        }

        $characters = $request->characters;
        $actors = $request->actors;
        $movie = Movie::create($attr);
        for ($i = 0; $i < count($characters); $i++) {
            MovieActor::create(['character_name' => $characters[$i], 'movie_id' => $movie->id, 'actor_id' => $actors[$i]]);
        }

        $movie->genres()->attach(request('genres'));
        return redirect('/');
    }

    public function edit($id)
    {
        $this->authorize('editMovie');

        $genres = Genre::get();
        $actors = Actor::get();
        $movie = Movie::find($id);
        // dd($movie->actors);
        return view('movies.edit', compact('movie', 'genres', 'actors'));
    }

    public function validateEdit(Request $request, $id)
    {
        $this->authorize('editMovie');
        $movie = Movie::find($id);
        $attr = $request->validate([
            'title' => 'required|min:2|max:50|unique:movies',
            'description' => 'required|min:8',
            'genres' => 'array|required',
            'actors' => 'array|required',
            'characters' => 'array|required',
            'director' => 'required|min:3',
            'date' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,gif',
            'background' => 'required|mimes:jpg,jpeg,png,gif'
        ]);

        if ($request->file('image')) {
            if ($movie->image_url) {
                Storage::delete('public/movies/thumbnail/' . $movie->image_url);
            }
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('storage/movies/thumbnail'), $filename);
            $attr['image_url'] = $filename;
        }

        if ($request->file('background')) {
            if ($movie->bg_url) {
                Storage::delete('public/movies/bg-image/' . $movie->background_url);
            }
            $file = $request->file('background');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('storage/movies/bg-image'), $filename);
            $attr['background_url'] = $filename;
        }

        $characters = $request->characters;
        $actors = $request->actors;
        $movie->update($attr);

        MovieActor::where('movie_id', $movie->id)->delete();

        for ($i = 0; $i < count($request->characters); $i++) {
            MovieActor::create(['character_name' => $characters[$i], 'movie_id' => $movie->id, 'actor_id' => $actors[$i]]);
        }
        $movie->genres()->sync(request('genres'));

        return redirect('/movie/' . $movie->id);
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
