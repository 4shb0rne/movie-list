<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if ($request->image_url) {
            $attr = $request->validate([
                'image_url' => 'required'
            ]);
            $user->image_url = $attr['image_url'];
            $user->save();
            return redirect('/profile');
        }

        $attr = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'dob' => 'required|date',
            'phone' => 'required|min:5|max:13',
        ]);
        $user->update($attr);
        return redirect('/profile');
    }
}
