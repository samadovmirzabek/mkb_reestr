@extends('layouts.admin')
@section('content')

               <div class="row" style="margin-top:30px;margin-right:15px">
                  <div class="col-sm-12">
                     <div class="card">
                        <div class="card-header">
                           <!-- <h4 class="card-title">Filial Datatable </h4>
                           <p class="card-text">
                              This is the most _____ example of the datatables ____ zero configuration. Use the  <code>.datatable </code> class to initialize __________.
                           </p> -->
                        </div>

                        <div class="card-body">
                           <div class="table-responsive">
                              <div class="btn_middle"  style="text-align:right">
                              <a href="{{ route('departament.create') }}" class="btn btn-primary">Departament Qo'shish</a>
                              </div>

                              <table class="datatable table table-stripped">
                                  @if($dep)
                                 <thead>
                                    <tr>
                                       <th>№</th>
                                       <th>Departament_Nomi </th>
                                       <th>Shtatda xodimlar soni </th>
                                       <th>Amaldagi xodimlar soni</th>
                                       <th>Vakant</th>
                                       <th>Edit </th>
                                       <th>Delete </th>
                                    </tr>
                                 </thead>
                                 <?php $i=1; ?>
                                 @foreach($dep as $d)
                                 <tbody>
                                    <tr>
                                       <td>{{$i++}}</td>
                                       <td>{{$d->dep_name}} </td>
                                       <td>{{$d->shatatda}}</td>
                                       <td>{{$d->amalda}} </td>
                                       <td>{{($d->shatatda)-($d->amalda)}} </td>
                                       <td>
                                           <form action="/departament/{{$d->id}}/edit" method="GET">
                                               @csrf
                                           <button type="submit" class="btn btn-warning">Edit</button>
                                           </form>
                                       </td>
                                       <td>
                                           <form action="{{route('departament.destroy',['departament'=>$d->id])}}" method="POST">
                                               @csrf
                                               @method('delete')
                                           <button type="submit" class="btn btn-danger">Delete</button>
                                           </form>
                                       </td>
                                    </tr>
                                 </tbody>
                                 @endforeach
                                 @endif
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

@endsection
