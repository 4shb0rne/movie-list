<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActorController extends Controller
{
    public function index(Request $request)
    {
        $actors = Actor::paginate(10);
        $pages = Actor::count() / 10;

        if ($request->ajax()) {
            if ($request->page) {
                $view = view('actor.data', compact('actors'))->render();
                return response()->json(['html' => $view]);
            } else if ($request->search == '') {
                $actors = Actor::get();
                $view = view('actor.data', compact('actors'))->render();
                return response()->json(['html' => $view]);
            } else {
                $actors = Actor::where('name', 'LIKE', '%' . $request->search . '%')->get();
                $view = view('actor.data', compact('actors'))->render();
                return response()->json(['html' => $view]);
            }
        }

        return view('actor.index', compact('actors', 'pages'));
    }

    public function show(Actor $actor)
    {
        return view('actor.show', compact('actor'));
    }

    public function create()
    {
        $this->authorize('addActor');

        $actor = new Actor();
        return view('actor.create', compact('actor'));
    }

    public function store(Request $request)
    {
        $this->authorize('addActor');

        $attr = $request->validate([
            'name' => 'required|min:3',
            'image_url' => 'required|mimes:jpeg,jpg,png,gif',
            'gender' => 'required',
            'biography' => 'required|min:10',
            'dob' => 'required',
            'place_of_birth' => 'required',
            'popularity' => 'required|numeric'
        ]);

        if ($request->file('image_url')) {
            $file = $request->file('image_url');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('storage/actors'), $filename);
            $attr['image_url'] = $filename;
        }

        Actor::create($attr);
        return redirect('/actor')->with('success-info', 'Add Actor Successfully');
    }

    public function edit(Actor $actor)
    {
        $this->authorize('addActor');

        return view('actor.edit', compact('actor'));
    }

    public function update(Request $request, Actor $actor)
    {
        $this->authorize('addActor');
        $attr = $request->validate([
            'name' => 'required|min:3',
            'image_url' => 'required|mimes:jpeg,jpg,png,gif',
            'gender' => 'required',
            'biography' => 'min:10',
            'dob' => 'required',
            'place_of_birth' => 'required',
            'popularity' => 'required|numeric'
        ]);

        if ($request->file('image_url')) {
            if ($actor->image_url) {
                Storage::delete('public/actors/' . $actor->image_url);
            }
            $file = $request->file('image_url');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('storage/actors'), $filename);
            $attr['image_url'] = $filename;
        }

        $actor->update($attr);
        return redirect('/actor/' . $actor->actor_id)->with('success-info', 'Update Actor Successfully');
    }

    public function destroy(Actor $actor)
    {
        $this->authorize('addActor');

        Storage::delete('public/actors/' . $actor->image_url);
        $actor->delete();
        return redirect('/actor')->with('success-info', 'Delete Actor Successfully');
    }
}
