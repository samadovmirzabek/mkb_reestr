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

class TexnikaController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:texnika-index|texnika-create|texnika-edit|texnika-delete', ['only' => ['index','show']]);
        $this->middleware('permission:texnika-create', ['only' => ['create','store']]);
        $this->middleware('permission:texnika-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:texnika-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->check()){
            if(Auth::user()->region_id){
               $region = Region::where('id',Auth::user()->region_id)->get();
            }
            else
            $region = Region::all();
       }
        $texnika = Electronica::get();
        $dep = Departament::get();
        $texnika = Texnika::get();
        $bolim = Bolim::get();
        return view('admin.texnika.index',['region'=>$region,'dep'=>$dep,'texnika'=>$texnika,'bolim'=>$bolim]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

        return view('admin.texnika.add',compact('region','dep','texnika','bolim'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        unset($inputs['region_id']);
        $texnika = new Electronica($inputs);
        $texnika->save();
        return redirect()->route('texnika.create')->with('success','Texnika created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $region = Region::all();
        $dep = Departament::all();
        $bolim = Bolim::all();
        $texnika = Texnika::all();
        $electronica = Electronica::with('filial')->with('dep')->with('texnika')->where('id',$id)->first();
        return view('admin.texnika.edit',['region'=>$region,'dep'=>$dep,'texnika'=>$texnika,'electronica'=>$electronica,'bolim'=>$bolim]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $texnika = Electronica::where('id',$id)->first();
        $params = $request->all();
        unset($params['region_id']);
        $texnika = $texnika->update($params);
        return redirect()->route('texnika.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $electronica = Electronica::find($id);
        $electronica->delete();
        return redirect()->route('texnika.index');
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
        
        return view('admin.texnika.index',[
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

    public function export($filial_id, $departament_id=null, $bolim_id = null,$texnika_id)
    {
        if($departament_id)
        {
            $search = Electronica::with('dep')->where('filial_id',$filial_id)
                ->where('texnika_id',$texnika_id)
                ->where('dep_id',$departament_id)->get();
        }
        elseif($bolim_id){
            $search = Electronica::with('bolim')->where('filial_id',$filial_id)->where('texnika_id',$texnika_id)
                ->where('bolim_id',$bolim_id)->get();
        }
        else{
            $search = Electronica::with('filial')->where('filial_id',$filial_id)
                ->where('texnika_id',$texnika_id)->get();
        }

        $data = [];
        foreach($search as $s){
            $arr = [
                'Texnika'=>$s->texnika->name ?? "",
                'Filial'=>$s->filial->filial_name ?? "",
                'Departament'=>$s->dep->dep_name ?? "",
                "Bolim"=>$s->bolim->name ?? "",
                "F.I>Sh"=>$s->user ?? "",
                "inverta_nomer"=>$s->inverta_nomer,
                "model"=>$s->model,
                "pratsessor"=>$s->protsessor ?? "",
                "ozu"=>$s->ozu ?? "",
                "tip_sistema"=>$s->tip_sistema ?? "",
                "printer_name"=>$s->printer_name ?? "",
                "year"=>$s->year ?? "",
                "storage"=>$s->storage ?? "",
                "tip_printer"=>$s->tip_printer ?? "",
                "monitor_name"=>$s->monitor_name ?? "",
                "monitor_size"=>$s->monitor_size ?? "" ,
                "Ip manzili"=>$s->ip ?? "",
            ];
            $data[]=$arr;
        }

        return Excel::download(new FilialExport($data), time().'.xlsx');
    }

}
