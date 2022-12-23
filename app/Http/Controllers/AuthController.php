<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('user.login');
    }

    public function loginAuth(Request $request)
    {
        // dd("ERROR");
        $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect('/')->with('success-info', 'Login Successfully');
        }else {
            return redirect('/login')->with('error', 'Invalid Credentials / Account not registerd...');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function register()
    {
        return view('user.register');
    }

    public function registerAuth(Request $request)
    {
        $attr = $request->validate([
            'username' => ['required', 'unique:users,name', 'min:5'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'alpha_num', 'min:6'],
            'confirm' => ['required', 'same:password']
        ]);

        $attr['name'] = $attr['username'];
        $attr['date_joined'] = Carbon::now();
        $attr['password'] = bcrypt($attr['password']);
        $attr['role'] = 'user';
        User::create($attr);

        return redirect('/login')->with('success-info', 'Account has been created');
    }
}
