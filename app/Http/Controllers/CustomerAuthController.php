<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;

class CustomerAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login_customer');
    }

    public function showRegisterForm()
    {
        return view('auth.register_customer');
    }

    public function loginCustomer(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('customers')->attempt($credentials)) {
            // Login berhasil
            return redirect()->route('dashboard.customer');
        } else {
            return redirect()->back()->withInput($request->only('username', 'remember'));
        }

        // Login gagal
        return redirect()->back()->withInput($request->only('username'));
    }

    public function registerCustomer(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'nama_customer' => 'required|string|max:200|min:3',
                'username' => 'required|string|min:3|unique:customer,username',
                'password' => 'required|min:4',
                'no_telp' => 'required|max:12',

            ]);

            Customer::create([
                'nama_customer' => $request->nama_customer,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'no_telp' => $request->no_telp,
            ]);

            return redirect()->route('customer.login')->with('status', 'Data telah tersimpan di database');
        }
    }

    public function logout()
    {
        Auth::guard('customers')->logout();
        return redirect('/');
    }
}
