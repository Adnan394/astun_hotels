<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register() {
        return view('auth.register');
    }
    public function login() {
        return view('auth.login');
    }

    public function register_store(Request $request) {

        $user = User::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 2,
        ]);

        if($user) {
            return redirect('/login');
        }
    }

    public function login_store(Request $request) {
        $guest = array(
            'email' => $request->email,
            'password' => $request->password,
            'role' => 2
        );
        $admin = array(
            'email' => $request->email,
            'password' => $request->password,
            'role' => 1
        );

        if(Auth::attempt($guest)) {
            return redirect('/');
        }
        elseif(Auth::attempt($admin)) {
            return redirect('/admin');
        }
        else {
            return redirect()->back()->with('error', 'Login Failed!, Please Check Username or Password');
        }
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }
}