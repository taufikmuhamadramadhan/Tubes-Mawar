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

}
