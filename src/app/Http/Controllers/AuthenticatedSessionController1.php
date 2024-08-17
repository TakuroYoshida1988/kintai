<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;  

class AuthenticatedSessionController1 extends Controller
{
    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // メールアドレスが登録されているか確認
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {

            return back()->withErrors(['email' => 'このメールアドレスは登録されていません。']);
        }

       if (Auth::attempt($credentials)) {

        $user = Auth::user();
        
        // メール認証が完了しているか確認
        if ($user->hasVerifiedEmail()) {

            //dd('完了');
            $request->session()->regenerate();
            return redirect()->intended('/'); // ログイン後のリダイレクト先
        } else {

            //dd('未完了');
            return redirect('/email/verify')->withErrors(['email' => 'メール認証が完了していません。']);
        }
     }

        return back()->withErrors(['email' => 'パスワードが一致しません。']);
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}