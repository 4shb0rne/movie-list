<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $attr = $request->validate([
            'username' => ['required', 'unique:users,name', 'min:5'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'alpha_num', 'min:6'],
            'confirm-password' => ['required', 'same:password']
        ]);

        $attr['name'] = $attr['username'];
        $attr['date_joined'] = Carbon::now();
        $attr['password'] = bcrypt($attr['password']);
        $attr['role'] = 'user';
        User::create($attr);

        return redirect('/login')->with('success-info', 'Account has been created');
    }
}
