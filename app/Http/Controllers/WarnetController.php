<?php

namespace App\Http\Controllers;
use App\Models\ListKomputer;
use App\Models\warnet;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Mpdf\Mpdf;


class WarnetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('warnet.index');
    }

    public function dataTable()
    {
        $warnet = warnet::select(['id_warnet', 'nama_warnet', 'alamat',]);
        return DataTables::of($warnet)
            ->addColumn('options', function ($warnet) {
                $editUrl = route('warnet.edit', $warnet->id_warnet);
                $deleteUrl = route('warnet.destroy', $warnet->id_warnet);
                return "<a href='$editUrl'><i class='fas fa-edit fa-lg'></i></a> <a style='border: none; background-color:transparent;' 
                class='hapusData' data-id='$warnet->id_warnet' data-url='$deleteUrl'><i class='fas fa-trash fa-lg text-danger'></i></a>";
            })
            ->rawColumns(['options'])
            ->make(true);
    }

    public function exportPdf()
    {
        $warnetData = Warnet::all(); // Use the correct model name

        $mpdf = new \Mpdf\Mpdf();
        $pdfHtml = view('warnet.pdf', compact('warnetData'))->render();

        $mpdf->WriteHTML($pdfHtml);
        $mpdf->Output('warnet_list.pdf', 'D');
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

        warnet::create($request->all());

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
        $warnet = warnet::findOrFail($id);
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
        $warnet = warnet::findOrFail($id);
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

        $warnet = warnet::findOrFail($id);
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
        $warnet = warnet::findOrFail($id);
        $warnet->delete();

        return redirect()->route('warnet.index')
            ->with('success', 'Warnet deleted successfully');
    }
}
