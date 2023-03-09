<?php

namespace App\Http\Controllers;

use App\Models\Departament;
use App\Models\Bolim;
use App\Models\Texnika;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class DepartamentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:departament-index|departament-create|departament-edit|departament-delete', ['only' => ['index','show']]);
        $this->middleware('permission:departament-create', ['only' => ['create','store']]);
        $this->middleware('permission:departament-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:departament-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dep = Departament::get();
        return view('departament.index',['dep'=>$dep]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departament.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);
        $dep = new Departament();
        $dep->filial_id = 1;
        $dep->dep_name = $request->name;
        $dep->shatatda = $request->shtatda;
        $dep->amalda = $request->amalda;
        $dep->save();
        return redirect()->route('departament.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departament  $departament
     * @return \Illuminate\Http\Response
     */
    public function show(Departament $departament)
    {
        //
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departament  $departament
     * @return \Illuminate\Http\Response
     */
    public function edit(Departament $departament)
    {
        $dep_id = $departament->id;
        $dep = Departament::where('id',$dep_id)->first();
        return view('departament.edit',['dep'=>$dep]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departament  $departament
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $dep_id)
    {
        $dep = Departament::where('id',$dep_id)->first();
        $action = Departament::where('id', $dep_id)->first()->update([
        'dep_name' => $request->dep_name,
        'shatatda' =>$request->shtatda,
        'amalda' =>$request->amalda
    ]);
        return redirect()->route('departament.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departament  $departament
     * @return \Illuminate\Http\Response
     */
    public function destroy($dep_id)
    {
        $dep=Departament::where('id',$dep_id);
        $dep->delete();
        return redirect()->back();
    }
    public function texnikalar()
    {
        $texnikas = Texnika::get();
        $dep = Departament::get();
        return view('departament.texnika',['texnikas'=>$texnikas,'dep'=>$dep]);
    }
    public function dep_bul($filial_id)
    {
        if(!(Auth::user()->region_id)==null)
        {
            return redirect()->back();
        }
        else{
                $filial_id = $filial_id;
                if($filial_id==1){
                $texnikas = Texnika::get();
                $dep = Departament::get();
            return view('departament.texnika',['texnikas'=>$texnikas,'dep'=>$dep]);
            }
            else{
                $texnikas = Texnika::get();
                $bolim = Bolim::get();
                return redirect()->back();
        // return view('admin.bolim.texnika',['texnikas'=>$texnikas,'bolim'=>$bolim,'filial_id'=>$filial_id]);
            }
        }
        
        
    }
}
