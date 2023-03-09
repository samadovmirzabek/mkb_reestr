<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Electronica;
use App\Models\Filial;
use App\Models\Texnika;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
   
    public function index(){
        if(!(Auth::user()->region_id)){
            $filial=Filial::paginate(14);
        }
        else{
            $filial=Filial::where('region_id',Auth::user()->region_id)->paginate(14);
        }
        $texnikas = Texnika::get();
        $electronica = Electronica::with('filial')->with('texnika')->get();
        return view('admin.home.index',[
            'texnikas'=>$texnikas,
            'filial'=>$filial,
            'electronica'=>$electronica
        ]);
    }
}
