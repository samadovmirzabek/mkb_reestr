<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Filial;
use App\Models\Departament;
use App\Models\Texnika;
use App\Models\Bolim;
use App\Models\Electronica;
use Illuminate\Support\Facades\Auth;
use Excel;
use App\Exports\FilialExport;

class UserController extends Controller
{

    public function index()
    {
        if(auth()->check()){
            if(Auth::user()->region_id){
               $region = Region::where('id',Auth::user()->region_id)->get();
            }
            else
            $region = Region::all();
       }
        $dep = Departament::all();
        $texnika = Texnika::all();
        $bolim = Bolim::all();
      return view('user.layout',compact('region','dep','texnika','bolim'));
    }

    public function search(Request $request)
    {

        $search = null;
        $region = Region::all();
        $dep = Departament::all();
        $texnika = Texnika::all();
        $inputs = $request->all();
        $tex_name = Texnika::where('id',$inputs['texnika_id'])->first();

        if (isset($inputs['dep_id']))
        {
            $search = Electronica::with('dep')->where('filial_id',$inputs['filial_id'])
            ->where('texnika_id',$inputs['texnika_id'])
            ->where('dep_id',$inputs['dep_id'])->get();
        }
        elseif(isset($inputs['bolim_id'])){
            $search = Electronica::with('bolim')->where('filial_id',$inputs['filial_id'])->where('texnika_id',$inputs['texnika_id'])
            ->where('bolim_id',$inputs['bolim_id'])->get();
        }
        else{

            $search = Electronica::with('filial')->where('filial_id',$inputs['filial_id'])
            ->where('texnika_id',$inputs['texnika_id'])->get();
        }
        
        return view('user.layout',[
            'region'=>$region,
            'dep'=>$dep,
            'texnika'=>$texnika,
            'search'=>$search,
            'tex_name'=>$tex_name,
            'f'=>$inputs['filial_id'] ?? "0",
            'b'=>$inputs['bolim_id'] ?? "0",
            'd'=>$inputs['dep_id'] ?? "0",
            't'=>$inputs['texnika_id'] ?? "0",
        ]);
    }
    public function filtex($filial_id,$texnika_id)
    {
        $search = null;
        if(auth()->check()){
            if(Auth::user()->region_id){
               $region = Region::where('id',Auth::user()->region_id)->get();
            }
            else
            $region = Region::all();
       }
       $filial = Filial::where('id',$filial_id)->get();
       $texnika = Texnika::all();
       $tex_name = Texnika::where('id',$texnika_id)->first();
       $search = Electronica::where('filial_id',$filial_id)->where('texnika_id',$texnika_id)->get();
       return view('user.layout3',[
        'region'=>$region,
        'texnika'=>$texnika,
        'search'=>$search,
        'tex_name'=>$tex_name,
        'f'=>$filial_id ?? "0",
        'b'=>$inputs['bolim_id'] ?? "0",
        'd'=>$departament_id ?? "0",
        't'=>$texnika_id ?? "0",
    ]);
    }
    public function search2($departament_id,$texnika_id)
    {
        $search = null;
        if(auth()->check()){
            if(Auth::user()->region_id){
               $region = Region::where('id',Auth::user()->region_id)->get();
            }
            else
            $region = Region::all();
       }
        $dep = Departament::all();
        $texnika = Texnika::all();
        $tex_name = Texnika::where('id',$texnika_id)->first();
        $search =  Electronica::with('dep')->where('filial_id',1)->where('dep_id',$departament_id)->where('texnika_id',$texnika_id)->get();
        return view('user.layout2',[
            'region'=>$region,
            'dep'=>$dep,
            'texnika'=>$texnika,
            'search'=>$search,
            'tex_name'=>$tex_name,
            'f'=>1 ?? "0",
            'b'=>$inputs['bolim_id'] ?? "0",
            'd'=>$departament_id ?? "0",
            't'=>$texnika_id ?? "0",
        ]);

    }

}
