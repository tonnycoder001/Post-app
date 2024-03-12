<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    // Register
    public function register(request $request)
    {

        // you can use the $incoming fiels or you can use the $this->validate method for validating the users details
        $incomingFields = $request->validate([
            // you can you the square brackets to validate the details or you can use only the single quotation marks
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:255'],
        ]);

        // Hashing the password
        $incomingFields['password'] = bcrypt($incomingFields['password']);

        // registering a new user and store the details
        $user = User::create($incomingFields);

        // login in a new user
        auth()->login($user);

        // redirecting the user
        return redirect('/');
    }

    // Logout
    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
        if (auth()->attempt(['name' => $incomingFields['name'], 'password' => $incomingFields['password']])) {
            $request->session()->regenerate();
        }

        return redirect('/');
    }
}
