<?php

namespace App\Http\Controllers;

use App\Models\ListKomputer;
use App\Models\NewBilling;
use Illuminate\Http\Request;

class DataKomputerController extends Controller
{
    public function index()
{
    $computers = ListKomputer::all();
    $billing = NewBilling::all();
    return view('dashboard.dataKomputer', compact('computers', 'billing'));
}


    public function store(Request $request)
    {
        $request->validate([
            'id_warnet' => 'required|exists:warnet,id_warnet',
            'id_komputer'=> 'required|exists:komputer,id_komputer',
            'id_customer'=> 'required|exists:customer,id_customer',
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

        // Validasi ulang setelah penambahan data exp_date dan harga
        $request->validate([
            'id_warnet' => 'required|exists:warnet,id_warnet',
            'id_komputer'=> 'required|exists:komputer,id_komputer',
            'id_customer'=> 'required|exists:customer,id_customer',
            'billing' => 'required',
            'exp_date' => 'required',
            'harga' => 'required',
        ]);

        // Simpan data ke dalam tabel NewBilling
        NewBilling::create($request->all());

        return redirect()->route('dashboard.dataKomputer')
            ->with('success', 'Berhasil Berhasil Horeee!');
    }
}