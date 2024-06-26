<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Register;
use App\Models\Member;
use Carbon\Carbon;

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

    public function register_index() {
        $title = "Đăng ký hội viên";
        return view('admin.register', compact('title'));
    }

    public function register(Register $request)
    {
        $data = $request->safe()->except('confirm_pass');
        
        $newUser = new User();
        $newUser->name = $data['name'];
        $newUser->email = $data['email'];
        $newUser->password = Hash::make($data['password']); 
        $newUser->role = $data['role'];
        $newUser->save();

        
        $newMember = new Member();
        $newMember->name = $data['name'];
        $newMember->email = $data['email'];
        $newMember->status = "active";
        $newMember->start = now();
        $newMember->end = $newMember->start->copy()->addYear();
        $newMember->user_id = $newUser->id; 

        $newMember->save();

        return redirect()->back()->with('success', "Đăng ký thành công");
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