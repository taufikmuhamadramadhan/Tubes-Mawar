<?php

namespace App\Http\Controllers;

use App\Models\ListKomputer;
use App\Models\NewBilling;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DataKomputerController extends Controller
{
    public function index()
    {
        $computers = ListKomputer::all();
        $billing = NewBilling::all();
        $users = User::all();
    
        // Gabungkan data dari ListKomputer, NewBilling, dan User
        $data = $computers->map(function ($computer) use ($billing, $users) {
            // Tambahkan data billing ke setiap komputer
            $computer->billing = $billing->where('id_komputer', $computer->id_komputer)->first();
    
            // Tambahkan data user ke setiap komputer
            $computer->user = $users->where('id', $computer->user_id)->first();
    
            return $computer;
        });
    
        return view('dashboard.dataKomputer', compact('data'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'id_warnet' => 'required|exists:warnet,id_warnet',
            'id_komputer'=> 'required|exists:list_komputer,id_komputer',
            'id_customer'=> 'required|exists:users,id',
            'billing' => 'required',
        ]);

        // Hitung harga berdasarkan billing
        $harga = $request->billing * 5000;

        // Hitung exp_date 2 bulan dari sekarang
        $expDate = date('Y-m-d', strtotime("+2 months"));

        // Tambahkan data exp_date dan harga ke dalam request
        $request->merge([
            'exp_date' => $expDate,
            'harga' => $harga,
        ]);        

        // Simpan data ke dalam tabel NewBilling
        NewBilling::create($request->all());

        return redirect()->route('dataKomputer.index')
            ->with('success', 'Berhasil Berhasil Horeee!');
    }
}