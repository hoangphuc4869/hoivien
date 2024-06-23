<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
    //    dd($request->all());
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        
        if (Auth::attempt($credentials)) {
           
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->withErrors(['email' => 'Vui lòng kiểm tra lại']);
    }

     public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate(); 

        $request->session()->regenerateToken(); 

        return redirect('/login'); 
    }

    // public function createUser()
    // {
        
    //     $user = new User();
    //     $user->name = 'Hoang Phuc';
    //     $user->email = '123@gmail.com';
    //     $user->password = Hash::make('123'); 
    //     $user->save();

    //     return 'User created successfully!';
    // }
}