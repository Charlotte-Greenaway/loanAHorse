<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

    /**
     * Show the login page
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function showLoginPage(Request $request)
        {
            //if the user is already logged in and the url is /sign-in, redirect to the homepage
            if (Auth::check() && $request->path() === 'sign-in') {
                return redirect()->route('home');
            }
            // Check if the user is already logged in and redirect them to the desired page
            if (Auth::check()) {
                // Redirect them to the desired page (e.g., the homepage or dashboard)
                return view($request->path());
            }

            // If not logged in, show the login page
            return view('sign-in');
        }

    /**
     * Register a new user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signIn(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            // Authentication passed, return a success response
            return redirect()->route('home');
        } else {
            // Authentication failed, return error response
            // Authentication failed, return back with error message
            return back()->withErrors(['sign-in' => 'Sorry, your credentials are incorrect. Please double-check your password or email.'])->withInput();
        }
    }

    /**
     * Register a new user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signUp(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'min:6',
                'regex:/[A-Z]/',       // At least one uppercase letter
                'regex:/[0-9]/',       // At least one number
                'regex:/[@$!%*?&]/',   // At least one special character
            ],
        ], [
            'name.required' => 'Please enter your name.',
            'email.unique' => 'The email address is already in use. Please choose a different one.',
            'password.min' => 'Your password must be at least 6 characters long.',
            'password.required' => 'Please enter a password.',
            'password.regex' => 'Your password must contain at least one uppercase letter, one number, and one special character.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
        ]);


        // Check if validation fails
        if ($validator->fails()) {
            // Get the current URL and append the hash
            $url = url()->previous() . '#register-form';

            // Return back with errors and input, and ensure the hash is included
            return redirect($url)->withErrors($validator)->withInput();
        }

        // Create a new user if validation passes
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Return a success response
        return redirect()->route('sign-in')->with('success', 'Your account has been created. You can now sign in.');
    }

    /**
     * Log the user out
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function signOut()
    {
        // Log the user out
        Auth::logout();

        // Redirect to the login page
        return redirect()->route('sign-in');
    }

}
