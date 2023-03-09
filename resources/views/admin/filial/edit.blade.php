@extends('layouts.admin')
@section('content')

<div class="row" style="margin-top:30px;margin-right:15px">
    <div class="col-md-12">
       <div class="card">
          <div class="card-header">
             <h5 class="card-title">Filiallarni O'zgartirish </h5>
          </div>
          <div class="card-body">
             <form action="{{ route('filial.update',['filial'=>$filial->id]) }}" method="POST">
                @csrf
                @method('put')
                <div class="row">
                   <div class="col-md-6">
                      <div class="form-group">
                         <label>Region Name </label>
                         <select class="select" name="region_id" required >
                            <option value="" disabled selected hidden></option>
                                @isset($region)
                                 @foreach($region as $key => $value)
                                 <option value="{{ $value->id }}">{{ $value->region_name }}
                                 </option>
                                 @endforeach
                                 @endisset

                         </select>
                      </div>
                   </div>
                   <div class="col-md-6">
                      <div class="form-group">
                         <label>Filial Nome </label>
                         <input type="text" class="form-control stil" name="filial_name" placeholder="filial_name" value="{{isset($filial) ? $filial->filial_name : old('filial_name')}}" />
                      </div>
                   </div>
                   <div class="col-md-6">
                    <div class="form-group">
                       <label>MFO </label>
                       <input type="text" class="form-control stil" name="filial_mfo" placeholder="filial_mfo" value="{{isset($filial) ? $filial->filial_mfo : old('filial_mfo')}}" />
                    </div>
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
