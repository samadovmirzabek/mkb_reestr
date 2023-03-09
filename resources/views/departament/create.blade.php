@extends('layouts.admin')
@section('content')

<div class="row" style="margin-top:30px;margin-right:15px">
    <div class="col-md-12">
       <div class="card">
          <div class="card-header">
             <h5 class="card-title" style="text-align:center">Departamentlarni Qo'shish Sahifasi</h5>
          </div>
          <div class="card-body">
             <form action="{{ route('departament.store') }}" method="POST">
                @csrf
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Departament nomi </label>
                           <input type="text" class="form-control" name="name"  required/>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Shtatdagi xodimlar soni</label>
                           <input type="text" class="form-control" name="shtatda"  required/>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Amaldagi xodimlar soni</label>
                           <input type="text" class="form-control" name="amalda"  required/>
                        </div>
                     </div>
                  </div>
                <div class="text-right">
                   <button type="submit" class="btn btn-primary">Qo'shish</button>
                </div>
             </form>
          </div>
       </div>
    </div>
 </div>

@endsection