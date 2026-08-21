<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;

class AuthController extends Controller
{
     public function signup(SignupRequest $request)
     {  
        
     
     $data = $request->validated();

       
      
     $user = User::create([

       'name' => $data['name'],
       'email' => $data['email'],
       'password' => Hash::make($data['password']),
     ]);

      return redirect()
         ->route('login')
         ->with('success','Account created successfully.please login.');
        
     }






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

}