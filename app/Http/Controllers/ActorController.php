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
            if ($request->page || $request->search=='') {
                $view = view('actors.card', compact('actors'))->render();
                return response()->json(['html' => $view]);
            } else {
                $actors = Actor::where('name', 'LIKE', '%' . $request->search . '%')->get();
                $view = view('actors.card', compact('actors'))->render();
                return response()->json(['html' => $view]);
            }
        }

        return view('actors.index', compact('actors', 'pages'));
    }

    public function detail(Actor $actor)
    {
        return view('actors.detail', compact('actor'));
    }

    public function add()
    {
        $this->authorize('modifyActor');

        $actor = new Actor();
        return view('actors.add', compact('actor'));
    }

    public function validateAdd(Request $request)
    {
        $this->authorize('modifyActor');

        $attr = $request->validate([
            'name' => 'required|min:3',
            'gender' => 'required',
            'biography' => 'required|min:10',
            'dob' => 'required',
            'place_of_birth' => 'required',
            'image_url' => 'required|mimes:jpeg,jpg,png,gif',
            'popularity' => 'required|numeric'
        ]);

        if ($request->file('image_url')) {
            $file = $request->file('image_url');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('storage/actors'), $filename);
            $attr['image_url'] = $filename;
        }

        Actor::create($attr);
        return redirect('/actor');
    }

    public function edit(Actor $actor)
    {
        $this->authorize('modifyActor');
        return view('actors.edit', compact('actor'));
    }

public function validateEdit(Request $request, Actor $actor)
    {
        $this->authorize('modifyActor');
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
        $this->authorize('modifyActor');

        Storage::delete('public/actors/' . $actor->image_url);
        $actor->delete();
        return redirect('/actor')->with('success-info', 'Delete Actor Successfully');
    }
}
