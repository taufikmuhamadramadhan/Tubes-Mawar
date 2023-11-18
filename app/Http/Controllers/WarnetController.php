<?php

namespace App\Http\Controllers;
use App\Models\warnet;
use Illuminate\Http\Request;


class WarnetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warnet = warnet::all();
        return view('warnet.index', compact('warnet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('warnet.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_warnet' => 'required',
            'alamat' => 'required',
        ]);

        Warnet::create($request->all());

        return redirect()->route('warnet.index')
            ->with('success', 'Warnet created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $warnet = Warnet::findOrFail($id);
        return view('warnet.show', compact('warnet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $warnet = Warnet::findOrFail($id);
        return view('warnet.edit', compact('warnet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_warnet' => 'required',
            'alamat' => 'required',
        ]);

        $warnet = Warnet::findOrFail($id);
        $warnet->update($request->all());

        return redirect()->route('warnet.index')
            ->with('success', 'Warnet updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $warnet = Warnet::findOrFail($id);
        $warnet->delete();

        return redirect()->route('warnet.index')
            ->with('success', 'Warnet deleted successfully');
    }
}
