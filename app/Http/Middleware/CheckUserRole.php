<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle($request, Closure $next, $role)
    {

        if (!Auth::check() || Auth::user()->role->name != $role) {
            // Redirect atau tampilkan pesan error
            return redirect('welcome');
        }

        // Menetapkan layout berdasarkan role
        $request->layout = 'layouts.base_' . strtolower($role) . '.base_dashboard';
        dd($request->layout);

        return $next($request);
    }
}
