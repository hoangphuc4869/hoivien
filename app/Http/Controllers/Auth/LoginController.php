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
use Illuminate\Support\Facades\Gate;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        
        $remember = $request->has('remember_token_') ? true : false;

        if (Auth::attempt($credentials, $remember)) {
            
            if (Auth::user()->status !== 'pending') {
                
                return redirect()->intended('/');
            }
            else {
                abort(403, 'Tài khoản của bạn chưa được xác nhận');
            }
        }
        
        return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng.']);
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
            return view('auth.register', compact('title'));
    }

    public function register(Register $request)
    {
        $data = $request->safe()->except('confirm_pass');
        // dd($data);
        
        $newUser = new User();
        $newUser->name = $data['name'];
        $newUser->email = $data['email'];
        $newUser->password = Hash::make($data['password']); 
        $newUser->save();

        return redirect()->back()->with('success', "Vui lòng chờ xác nhận của quản trị viên");
    }


   public function createUser()
    {
        // Tạo một người dùng có vai trò là admin
        $user = new User();
        $user->email = "hsma@admin.com";
        $user->name = "Quản trị viên";
        $user->role = 'admin';
        $user->password = Hash::make('123'); // Mã hóa mật khẩu '123' bằng bcrypt
        $user->save();

        return response()->json(['message' => 'Admin user created successfully'], 200);
    }
}