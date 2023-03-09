@extends('layouts.admin')
@section('content')

<div class="row" style="margin-top:30px;margin-right:15px">
    <div class="col-md-12">
       <div class="card">
          <div class="card-header">
             <h5 class="card-title">Departamentlarni Tahrirlash </h5>
          </div>
          <div class="card-body">
             <form action="{{ route('departament.update',['departament'=>$dep->id]) }}" method="POST">
                @csrf
                @method('put')
                   <div class="col-md-6">
                      <div class="form-group">
                         <label>Departament Nomi </label>
                         <input type="text" class="form-control stil" name="dep_name" placeholder="dep_name" value="{{isset($dep) ? $dep->dep_name : old('dep_name')}}" />
                      </div>
                   </div>
                   <div class="col-md-6">
                      <div class="form-group">
                         <label>Shtatdagi xodimlar soni</label>
                         <input type="text" class="form-control stil" name="shtatda" placeholder="shtatda" value="{{isset($dep) ? $dep->shatatda : old('shatatda')}}" />
                      </div>
                   </div>
                   <div class="col-md-6">
                      <div class="form-group">
                         <label>Amaldagi xodimlar soni</label>
                         <input type="text" class="form-control stil" name="amalda" placeholder="amalda" value="{{isset($dep) ? $dep->amalda : old('amalda')}}" />
                      </div>
                   </div>
                <div class="text-right">
                   <button type="submit" class="btn btn-primary">Saqlash</button>
                </div>
             </form>
          </div>
       </div>
    </div>
 </div>

@endsection
