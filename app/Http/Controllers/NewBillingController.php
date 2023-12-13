<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewBilling;

class NewBillingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $billings = NewBilling::all();
        return view('billing.index', compact('billings'));
    }

    public function exportPdf()
    {
        $billings = NewBilling::all(); // Use the correct model name

        $mpdf = new \Mpdf\Mpdf();
        $pdfHtml = view('billing.pdf', compact('billings'))->render();

        $mpdf->WriteHTML($pdfHtml);
        $mpdf->Output('billing_list.pdf', 'D');
    }

}
