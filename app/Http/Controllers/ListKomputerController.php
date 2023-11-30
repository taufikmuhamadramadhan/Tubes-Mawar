<?php

namespace App\Http\Controllers;

use App\Models\ListKomputer;
use App\Models\Warnet;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class ListKomputerController extends Controller
{
    public function index()
    {
        return view('list_komputer.index');
    }

    public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = ListKomputer::with('warnet')->select('list_komputer.*');

            return DataTables::of($data)
                ->addColumn('options', function ($listKomputer) {
                    $editUrl = route('list_komputer.edit', $listKomputer->id_komputer);
                    $deleteUrl = route('list_komputer.destroy', $listKomputer->id_komputer);
                    return "<a href='$editUrl'><i class='fas fa-edit fa-lg'></i></a> <a style='border: none; background-color:transparent;' class='hapusData' data-id='$listKomputer->id_komputer' data-url='$deleteUrl'><i class='fas fa-trash fa-lg text-danger'></i></a>";
                })
                ->addColumn('nama_warnet', function ($listKomputer) {
                    return $listKomputer->warnet ? $listKomputer->warnet->nama_warnet : '';
                })
                ->rawColumns(['options'])
                ->make(true);
        }

        return view('list_komputer.index');
    }

    public function exportPdf()
    {
        $listKomputerData = ListKomputer::with('warnet')->get();

        $mpdf = new \Mpdf\Mpdf();
        
        $pdfHtml = view('list_komputer.pdf', compact('listKomputerData'))->render();

        $mpdf->WriteHTML($pdfHtml);
        $mpdf->Output('list_komputer.pdf', 'D');
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
