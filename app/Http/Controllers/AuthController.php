<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use Illuminate\Http\Request;
use App\Models\Department;

class AuthController extends Controller
{
      // department in signup
    public function showSignup()
    {
       $departments = Department::where('status', 1)->get();

       return view('signup', compact('departments'));
    }
     public function signup(SignupRequest $request)
     {  
    
     $user = User::create([

        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'department_id' => $request->department_id,
     ]);

       $user->assignRole('Customer');
       
      return redirect()
         ->route('login')
         ->with('success','Account created successfully.please login.'); 
     }
 
        // login function
     public function login(LoginRequest $request)
{
    $credentials = $request->validated();

    $user = User::where('email', $credentials['email'])->first();

    if (!$user) {
        return back()
            ->withErrors([
                'email' => 'Email is not registered.',
            ])
            ->withInput();
    }

    if (!Hash::check($credentials['password'], $user->password)) {
        return back()
            ->withErrors([
                'password' => 'Password is incorrect.',
            ])
            ->withInput();
    }

    Auth::login($user);

    $request->session()->regenerate();

    return redirect()
        ->route('home');
}   
   
    // logout function
  public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
}

}