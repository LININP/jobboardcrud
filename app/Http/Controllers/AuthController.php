<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
 public function login(){
    return view('login');
 }

 public function registration(){
    return view('register');
 }

 public function signup(Request $request)
 {
     $user = new User();
     $user->name = $request->input('name');
     $user->email = $request->input('email');
     $user->role = $request->input('role');
     $user->password = Hash::make($request->input('password'));
     $user->save();

     return redirect('/loginpage');
 }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            ''
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $role = $user->role;

            if ($role === 'admin') {
                return redirect()->intended('admin/dashboard-admin');
            } elseif ($role === 'employer') {
                return redirect()->intended('employer/dashboard');
            } elseif ($role === 'jobseekker') {
                return redirect()->intended('jobseeker/dashboard');
            }

            return redirect()->intended('dashboard');
        }
        dd($credentials);


        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}




