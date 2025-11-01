<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ChangePasswordRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return response()->json([
            'success' => true,
            'message' => 'User registered successfully.',
        ], 201);
    }

    public function showLoginForm()
    {
        return view('Auth.login');
    }

    // 🔹 تنفيذ عملية تسجيل الدخول
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard')
                ->with('success', 'تم تسجيل الدخول بنجاح ✅');
        }

        return back()->withErrors([
            'email' => 'هناك خطا في الايميل او الباسورد.',
        ]);
    }


    public function changePassword(ChangePasswordRequest $request)
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();
        $user->update([
            'password' => Hash::make($data['password']),
        ]);
        return response()->json([
            'message' => 'Password changed successfully.'
        ], 200);
    }


    public function logout(Request $request)
    {
        Auth::logout(); // تسجيل الخروج من السيشن

        $request->session()->invalidate(); // إلغاء الجلسة القديمة
        $request->session()->regenerateToken(); // إنشاء CSRF جديد
        return redirect('/')->with('success', 'تم تسجيل الخروج بنجاح ✅');
    }
}
