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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate incoming request
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['required', 'string', 'max:15'],
            'address' => ['required', 'string', 'max:255'],
            'photo' => ['required', 'image', 'max:2048'], // Make photo required
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
    
        // Generate a new filename with a timestamp to avoid collisions
        $photoName = date('YmdHi') . '_' . $request->file('photo')->getClientOriginalName();
    
        // Move the uploaded photo to the desired directory
        $request->file('photo')->move(public_path('upload/admin_images'), $photoName);

        $role = $request->role;
    
        // Create user with provided data
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'photo' => $photoName, // Store only the image name
            'password' => Hash::make($request->password),
            'role' => $role, // Default role set as 'User'
    
        ]);
    
        // Fire the Registered event
        event(new Registered($user));
    
        // Log the user in
        Auth::login($user);
    
        // Redirect based on role
        if ($user->role === 'User') {
            return redirect()->route('userinfo'); // Redirect to userinfo for regular users
        } elseif ($user->role === 'Professional') {
            return redirect()->route('Professional.info'); // Redirect to Professional info
        }
    
        // Default redirect 
        return redirect()->route('home');
    }

    public function PorfessionalReg():view{
        

        return view('auth.PorfessionalReg');
    }
    
}
