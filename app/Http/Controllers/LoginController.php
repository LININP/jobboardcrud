<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'role' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput();
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->role = $request->input('role');
        if ($request->input('role') == 'employee') {
            $user->status = 1;
        }
        $user->password = Hash::make($request->input('password'));
        $user->save();

        // Perform necessary actions with the form data, such as saving to a database

        return redirect('/');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->status == 0) {
                return back()->withErrors([
                    'is_approved' => 'User not approved.',
                ]);
            }
            $role = $user->role;

            if ($role === 'admin') {
                return redirect()->intended('admin/dashboard-admin');
            } elseif ($role === 'employer') {
                return redirect()->intended('employer/dash-employer');
            } elseif ($role === 'employee') {
                return redirect()->intended('employee/jobcard');
            }

            return redirect()->intended('dashboard');
        }

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
