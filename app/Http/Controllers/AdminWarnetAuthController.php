<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminWarnetAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login_admin'); // asumsikan Anda memiliki view terpisah untuk admin
    }

    public function login_admin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('admin_warnets')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Perbarui ini untuk merujuk ke nama route yang tepat
            return redirect()->route('adminWarnet.dashboard');
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('admin_warnets')->logout();
        return redirect('/');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
