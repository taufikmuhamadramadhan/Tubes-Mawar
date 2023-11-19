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

    public function dataTable(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
            0 => 'warnet.nama_warnet',
            1 => 'id_komputer',
            2 => 'processor',
            3 => 'ram',
            4 => 'gpu',
        );

        $totalDataRecord = ListKomputer::count();

        $totalFilteredRecord = $totalDataRecord;

        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $komputer_data = ListKomputer::with('warnet')
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val, $dir_val)
                ->get();
        } else {
            $search_text = $request->input('search.value');

            $komputer_data = ListKomputer::with('warnet')
                ->where('id_komputer', 'LIKE', "%{$search_text}%")
                ->orWhere('processor', 'LIKE', "%{$search_text}%")
                ->orWhere('ram', 'LIKE', "%{$search_text}%")
                ->orWhere('gpu', 'LIKE', "%{$search_text}%")
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val, $dir_val)
                ->get();

            $totalFilteredRecord = ListKomputer::where('id_komputer', 'LIKE', "%{$search_text}%")
                ->orWhere('processor', 'LIKE', "%{$search_text}%")
                ->orWhere('ram', 'LIKE', "%{$search_text}%")
                ->orWhere('gpu', 'LIKE', "%{$search_text}%")
                ->count();
        }

        $data_val = array();
        if (!empty($komputer_data)) {
            foreach ($komputer_data as $komputer_val) {
                $url = route('list_komputer.edit', ['id_komputer' => $komputer_val->id_komputer]);
                $urlHapus = route('list_komputer.destroy', $komputer_val->id_komputer);

                $komputerNestedData['warnet.nama_warnet'] = $komputer_val->warnet->nama_warnet;
                $komputerNestedData['id_komputer'] = $komputer_val->id_komputer;
                $komputerNestedData['processor'] = $komputer_val->processor;
                $komputerNestedData['ram'] = $komputer_val->ram;
                $komputerNestedData['gpu'] = $komputer_val->gpu;
                $komputerNestedData['options'] = "<a href='$url'><i class='fas fa-edit fa-lg'></i></a> <a style='border: none; background-color:transparent;' class='hapusData' data-id='$komputer_val->id' data-url='$urlHapus'><i class='fas fa-trash fa-lg text-danger'></i></a>";
                $data_val[] = $komputerNestedData;
            }
        }

        $draw_val = $request->input('draw');
        $get_json_data = array(
            "draw"            => intval($draw_val),
            "recordsTotal"    => intval($totalDataRecord),
            "recordsFiltered" => intval($totalFilteredRecord),
            "data"            => $data_val
        );

        return response()->json($get_json_data);

    }
}
