<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Electronica;
use App\Exports\MkbExport;
use App\Exports\MkbExportView;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function index(){
        $electronica = Electronica::all();
        return view('user.layout',compact('electronica'));
    }
    public function export()
    {
        return Excel::download(new MkbExport(),'customers.xlsx');
    }
    public function export_view()
    {
        return Excel::download(new MkbExportView(),'customers.xlsx');
    }
}
