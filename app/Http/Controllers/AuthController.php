<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view("authentication.register");
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);


        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'roles' => 'U'
        ]);

        Auth::login($user);

        // Return a success response with the created user's data
        return redirect()->route("login")->withSuccess("Successfully Register!");
    }

    public function login()
    {
        return view('authentication.login');
    }

    public function login_fetch(Request $request)
    {
        
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to find the user with the provided email

        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = User::where('email', $request->email)->first();
            Auth::login($user);
            return redirect()->route("index-home");
        } else {
            return back()->withErrors(['error' => 'Invalid credentials.'])->withInput();
        }

        // Return a success response with the token
        return redirect()->route("index-home");
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
