<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customer.index');
    }

    public function dataTable()
    {
        return DataTables::of(Customer::select('*'))
            ->addColumn('options', function ($customer) {
                $editUrl = route('customer.edit', $customer->id_customer);
                $deleteUrl = route('customer.delete', $customer->id_customer);
                return "<a href='$editUrl'><i class='fas fa-edit fa-lg'></i></a> <a style='border: none; background-color:transparent;' class='hapusData' data-id='$customer->id_customer' data-url='$deleteUrl'><i class='fas fa-trash fa-lg text-danger'></i></a>";
            })
            ->rawColumns(['options'])
            ->make(true);
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $id_customer = $request->input('id_customer');

            $data = Customer::where('id_customer', $id_customer)
                ->select('*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('customer.edit', $row->id_customer);
                    $deleteUrl = route('customer.delete', $row->id_customer);
                    $actionBtn = "<a href='$editUrl' class='edit btn btn-success btn-sm'>Edit</a> <a href='javascript:void(0)' class='delete btn btn-danger btn-sm' data-id='$row->id_customer' data-url='$deleteUrl'>Delete</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('customer.index');
    }

    public function tambahCustomer(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'nama_customer' => 'required|string|max:200|min:3',
                'username' => 'required|string|min:3|unique:customer,username',
                'password' => 'required|min:4',
                'billing' => 'required|integer',
                'no_telp' => 'required|integer',
                'create_date' => 'required|date',
            ]);

            Customer::create([
                'nama_customer' => $request->nama_customer,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'billing' => $request->billing,
                'no_telp' => $request->no_telp,
                'create_date' => $request->create_date,
            ]);

            return redirect()->route('customer.index')->with('status', 'Data telah tersimpan di database');
        }

        return view('customer.addCustomer');
    }

    public function ubahCustomer($id_customer, Request $request)
    {
        $customer = Customer::findOrFail($id_customer);

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'nama_customer' => 'required|string|max:200|min:3',
                'username' => 'required|string|min:3|unique:customer,username,' . $customer->id_customer . ',id_customer',
                'billing' => 'required|integer',
                'no_telp' => 'required|integer',
                'create_date' => 'required|date',
            ]);
            

            $customer->update([
                'nama_customer' => $request->nama_customer,
                'username' => $request->username,
                'billing' => $request->billing,
                'no_telp' => $request->no_telp,
                'create_date' => $request->create_date,
            ]);

            return redirect()->route('customer.index')->with('status', 'Data telah tersimpan di database');
        }

        return view('customer.editCustomer', ['customer' => $customer]);
    }

    public function hapusCustomer($id_customer)
    {
        $customer = Customer::findOrFail($id_customer);

        $customer->delete();
        return response()->json([
            'msg' => 'Data yang dipilih telah dihapus'
        ]);
    }
}
