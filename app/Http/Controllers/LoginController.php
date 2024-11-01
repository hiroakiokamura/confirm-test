<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        // バリデーションはLoginRequestで行われる
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            // 認証成功後のリダイレクト
            return redirect()->intended('/auth/admin');
        }

        // 認証失敗時のエラーメッセージ
        return back()->withErrors([
            'email' => '認証に失敗しました。もう一度お試しください。',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');  // ログアウト後にloginページへリダイレクト
    }
}
