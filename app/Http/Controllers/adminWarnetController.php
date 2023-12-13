<?php

namespace App\Http\Controllers;

use App\Models\AdminWarnet;
use App\Models\warnet;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AdminWarnetExport;

class adminWarnetController extends Controller
{

    public function dashboard()
    {
        return view('dashboard.adminWarnet');
    }

    public function index()
    {

        return view('page.admin.adminWarnet.index');
    }

    public function dataTable()
    {
        return DataTables::of(AdminWarnet::with('warnet')->select('*'))
            ->addColumn('options', function ($adminWarnet) {
                $editUrl = route('adminWarnet.edit', $adminWarnet->id_adminWarnet);
                $deleteUrl = route('adminWarnet.delete', $adminWarnet->id_adminWarnet);
                return "<a href='$editUrl'><i class='fas fa-edit fa-lg'></i></a> <a style='border: none; background-color:transparent;' class='hapusData' data-id='$adminWarnet->id_adminWarnet' data-url='$deleteUrl'><i class='fas fa-trash fa-lg text-danger'></i></a>";
            })
            ->addColumn('nama_warnet', function ($adminWarnet) {
                return $adminWarnet->warnet->nama_warnet;
            })
            ->rawColumns(['options'])
            ->make(true);
    }

    public function export()
    {
        return Excel::download(new AdminWarnetExport(), 'adminWarnet.xlsx');
    }

    // public function getData(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $id_warnet = $request->input('id_warnet'); // Adjust this line based on how you pass the id_warnet

    //         $data = AdminWarnet::with('warnet:id_warnet,nama_warnet')
    //             ->where('id_warnet', $id_warnet)
    //             ->select('*');

    //         return datatables()->of($data)
    //             ->addIndexColumn()
    //             ->addColumn('action', function ($row) {
    //                 $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
    //                 return $actionBtn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }

    //     return view('page.admin.adminWarnet.index');
    // }

    // public function dataTable(Request $request)
    // {
    //     $totalFilteredRecord = $totalDataRecord = $draw_val = "";
    //     $columns_list = array(
    //         0 => 'name',
    //         1 => 'email',
    //         2 => 'nameWarnet', // Menambahkan kolom nameWarnet
    //         3 => 'id',
    //     );

    //     $totalDataRecord = AdminWarnet::count();

    //     $totalFilteredRecord = $totalDataRecord;

    //     $limit_val = $request->input('length');
    //     $start_val = $request->input('start');
    //     $order_val = $columns_list[$request->input('order.0.column')];
    //     $dir_val = $request->input('order.0.dir');

    //     if (empty($request->input('search.value'))) {
    //         $akun_data = AdminWarnet::where('id', '!=', Auth::id())
    //             ->offset($start_val)
    //             ->limit($limit_val)
    //             ->orderBy($order_val, $dir_val)
    //             ->get();
    //     } else {
    //         $search_text = $request->input('search.value');

    //         $akun_data =  AdminWarnet::where('id', '!=', Auth::id())
    //             ->where('id', 'LIKE', "%{$search_text}%")
    //             ->orWhere('name', 'LIKE', "%{$search_text}%")
    //             ->orWhere('email', 'LIKE', "%{$search_text}%")
    //             ->orWhere('nameWarnet', 'LIKE', "%{$search_text}%") // Menambahkan pencarian untuk nameWarnet
    //             ->offset($start_val)
    //             ->limit($limit_val)
    //             ->orderBy($order_val, $dir_val)
    //             ->get();

    //         $totalFilteredRecord = AdminWarnet::where('id', '!=', Auth::id())
    //             ->where('id', 'LIKE', "%{$search_text}%")
    //             ->orWhere('name', 'LIKE', "%{$search_text}%")
    //             ->orWhere('email', 'LIKE', "%{$search_text}%")
    //             ->orWhere('nameWarnet', 'LIKE', "%{$search_text}%") // Menambahkan pencarian untuk nameWarnet
    //             ->count();
    //     }

    //     $data_val = array();
    //     if (!empty($akun_data)) {
    //         foreach ($akun_data as $akun_val) {
    //             $url = route('adminWarnet.edit', ['id' => $akun_val->id]);
    //             $urlHapus = route('adminWarnet.delete', $akun_val->id);

    //             $akunnestedData['name'] = $akun_val->name;
    //             $akunnestedData['email'] = $akun_val->email;
    //             $akunnestedData['nameWarnet'] = $akun_val->nameWarnet; // Menambahkan nameWarnet
    //             $akunnestedData['options'] = "<a href='$url'><i class='fas fa-edit fa-lg'></i></a> <a style='border: none; background-color:transparent;' class='hapusData' data-id='$akun_val->id' data-url='$urlHapus'><i class='fas fa-trash fa-lg text-danger'></i></a>";
    //             $data_val[] = $akunnestedData;
    //         }
    //     }
    //     $draw_val = $request->input('draw');
    //     $get_json_data = array(
    //         "draw"            => intval($draw_val),
    //         "recordsTotal"    => intval($totalDataRecord),
    //         "recordsFiltered" => intval($totalFilteredRecord),
    //         "data"            => $data_val
    //     );

    //     return response()->json($get_json_data);
    // }

    public function tambahAdminWarnet(Request $request)
    {

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|string|max:200|min:3',
                'email' => 'required|string|min:3|email|unique:users,email',
                'password' => 'required|min:4|confirmed',
                'password_confirmation' => 'required|min:4',
                'id_warnet' => 'required',
            ]);

            AdminWarnet::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'id_warnet' => $request->id_warnet,
            ]);

            return redirect()->route('adminWarnet.index')->with('status', 'Data telah tersimpan di database');
        }

        // Mengambil daftar warnet untuk ditampilkan dalam dropdown
        $warnets = Warnet::all();

        return view('page.admin.adminWarnet.addAdmin', compact('warnets'));
    }

    public function ubahAdminWarnet($id_adminWarnet, Request $request)
    {
        $usr = AdminWarnet::findOrFail($id_adminWarnet);
        $warnets = Warnet::all();
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|string|max:200|min:3',
                'email' => 'required|string|min:3|email|unique:users,email,' . $usr->id_adminWarnet,
                'id_warnet' => 'required', // Validate the existence of id_warnet in the warnet table
            ]);

            $usr->update([
                'name' => $request->name,
                'email' => $request->email,
                'id_warnet' => $request->id_warnet,
            ]);

            return redirect()->route('adminWarnet.index', ['id_adminWarnet' => $usr->id_adminWarnet])->with('status', 'Data telah tersimpan di database');
        }

        return view('page.admin.adminWarnet.ubahAdmin', [
            'usr' => $usr,
            'warnets' => $warnets,
        ]);
    }

    public function hapusAdminWarnet($id_adminWarnet)
    {
        $usr = AdminWarnet::findOrFail($id_adminWarnet);

        $usr->delete($id_adminWarnet);
        return response()->json([
            'msg' => 'Data yang dipilih telah dihapus'
        ]);
    }
}
