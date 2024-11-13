<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            session(['user_type' => 'user']);
            return redirect()->route('home');
        }

        
        return redirect()->back()->with('error', 'Invalid credentials.');
    }

    public function adminLogin(Request $request)
    {
    
        $credentials = $request->only('username', 'password');

        
        if (Auth::guard('admin')->attempt($credentials)) {
    
            session(['user_type' => 'admin']);

            return redirect()->route('admin.dashboard');
        }


        return redirect()->back()->with('error', 'Invalid credentials.');
    }

    public function logout(Request $request)
    {
        
        Auth::logout();
        $request->session()->forget('user_type');

        
        return redirect()->route('login');
    }
}
