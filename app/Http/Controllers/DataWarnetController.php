<?php

namespace App\Http\Controllers;

use App\Models\Warnet;
use Illuminate\Http\Request;

class DataWarnetController extends Controller
{
    public function index()
    {

        $warnets = Warnet::all();
        return view('dashboard.dataWarnet', compact('warnets'));
    }
}
