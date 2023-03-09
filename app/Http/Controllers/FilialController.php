<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Filial;
use App\Models\Departament;

class FilialController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:filial-index|filial-create|filial-edit|filial-delete', ['only' => ['index','show']]);
        $this->middleware('permission:filial-create', ['only' => ['create','store']]);
        $this->middleware('permission:filial-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:filial-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filial = Filial::get();
        return view('admin.filial.index',['filial'=>$filial]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $region = Region::all();
        return view('admin.filial.add',compact('region'));

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
        $filial = new Filial($inputs);
        $filial->save();
        return redirect()->route('filial.index');
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
    public function edit($filial_id)
    {
        $filial = Filial::where('id',$filial_id)->first();
        $region = Region::get();
        return view('admin.filial.edit',['filial'=>$filial,'region'=>$region]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $filial_id)
    {
        $filial = Filial::where('id',$filial_id)->first();
        $params = $request->all();
        $filial = $filial->update($params);
        return redirect()->route('filial.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($filial_id)
    {
        $filial = Filial::where('id',$filial_id);
        $filial->delete();
        return redirect()->back();
    }

    public function getFilial(Request  $request)
    {
        $region_id = $request->id;
        $filial = Filial::where('region_id', $region_id)->get();
        return [
            'filial' => $filial,
        ];
    }
    public function getFilials(Request  $request)
    {
        $region_id = $request->id;
        $filial = Filial::where('region_id', $region_id)->where('id', '!=',1)->get();
        return [
            'filial' => $filial,
        ];
    }

    public function getDep(Request  $request)
    {
        $filial_id = $request->id;
        $exists = Departament::where('filial_id', $filial_id)->exists();
        return [
            'exists' => $exists,
        ];
    }
}
