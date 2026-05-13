<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'birthdate' => ['required', 'date'],
            'age' => ['required', 'integer'],
            'gender' => ['required', 'string'],
            'civil_status' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'purok' => ['nullable', 'string', 'max:100'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'birthdate' => $request->birthdate,
            'age' => $request->age,
            'gender' => $request->gender,
            'civil_status' => $request->civil_status,
            'phone' => $request->phone,
            'address' => $request->address,
            'purok' => $request->purok,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return redirect()->route('login')->with('status', 'Registration successful!');
    }
}
