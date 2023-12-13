<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

        Log::info('Trying to login with email: ' . $request->email); // Log email for debugging

        if (Auth::guard('admin_warnets')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            Log::info('Login successful for email: ' . $request->email);
            return redirect()->route('adminWarnet.dashboard');
        }

        Log::warning('Login failed for email: ' . $request->email);
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('admin_warnets')->logout();
        return redirect()->route('admin.login');
    }
}
