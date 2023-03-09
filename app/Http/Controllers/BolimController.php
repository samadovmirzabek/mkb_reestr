<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bolim;
use App\Models\Region;
use App\Models\Departament;
use App\Models\Texnika;
class BolimController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:bolim-index|bolim-create|bolim-edit|bolim-delete', ['only' => ['index','show']]);
        $this->middleware('permission:bolim-create', ['only' => ['create','store']]);
        $this->middleware('permission:bolim-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:bolim-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bolim = Bolim::get();
        return view('admin.bolim.index',['bolim'=>$bolim]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $region = Region::all();
        return view('admin.bolim.create',compact('region'));
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
        $filial = new Bolim($inputs);
        $filial->save();
        return redirect()->route('bolim.index');
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
        $bolim = Bolim::where('id',$id)->first();
        return view('admin.bolim.edit',['bolim'=>$bolim]);
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
        $bolim = Bolim::where('id',$id)->first();
        $params = $request->all();
        $bolim = $bolim->update($params);
        return redirect()->route('bolim.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bolim = Bolim::where('id',$id)->delete();
        return redirect()->back();
    }
}
