@extends('layouts.admin')
@section('content')

<div class="row" style="margin-top:30px;margin-right:15px">
    <div class="col-md-12">
       <div class="card">
          <div class="card-header">
             <h5 class="card-title">Bo'limlarni Tahrirlash </h5>
          </div>
          <div class="card-body">
             <form action="{{ route('bolim.update',['bolim'=>$bolim->id]) }}" method="POST">
                @csrf
                @method('put')
                   <div class="col-md-6">
                      <div class="form-group">
                         <label>Departament nomi </label>
                         <input type="text" class="form-control stil" name="name" placeholder="name" value="{{isset($bolim) ? $bolim->name : old('name')}}" />
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
