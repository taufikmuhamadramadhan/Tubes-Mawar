<?php

namespace App\Http\Controllers;

use App\Models\ListKomputer;
use App\Models\warnet;
use Illuminate\Http\Request;

class ListKomputerController extends Controller
{
    public function index()
    {
        $listKomputers = ListKomputer::with('warnet')->get();
        return view('list_komputer.index', compact('listKomputers'));
    }

    public function create()
    {
        $warnets = Warnet::all();
        return view('list_komputer.create', compact('warnets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_warnet' => 'required|exists:warnet,id_warnet',
            'nama_komputer' => 'required',
            'processor' => 'required',
            'ram' => 'required',
            'gpu' => 'required',
        ]);

        ListKomputer::create($request->all());

        return redirect()->route('list_komputer.index')
            ->with('success', 'Data komputer berhasil ditambahkan!');
    }

    public function show($id)
    {
        $listKomputer = ListKomputer::with('warnet')->find($id);
        return view('list_komputer.show', compact('listKomputer'));
    }

    public function edit($id)
    {
        $listKomputer = ListKomputer::find($id);
        $warnets = Warnet::all();
        return view('list_komputer.edit', compact('listKomputer', 'warnets'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_warnet' => 'required|exists:warnet,id_warnet',
            'nama_komputer' => 'required',
            'processor' => 'required',
            'ram' => 'required',
            'gpu' => 'required',
        ]);

        $listKomputer = ListKomputer::find($id);
        $listKomputer->update($request->all());

        return redirect()->route('list_komputer.index')
            ->with('success', 'Data komputer berhasil diperbarui!');
    }

    public function destroy($id)
    {
        ListKomputer::destroy($id);

        return redirect()->route('list_komputer.index')
            ->with('success', 'Data komputer berhasil dihapus!');
    }
}
