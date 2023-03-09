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
                              <a href="{{ route('filial.create') }}" class="btn btn-primary">Filial Qo'shish</a>
                              </div>

                              <table class="datatable table table-stripped">
                                  @if($filial)
                                 <thead>
                                    <tr>
                                       <th>№</th>
                                       <th>Filial_Nomi </th>
                                       <th>MFO </th>
                                       <th>Edit </th>
                                       <th>Delete </th>
                                    </tr>
                                 </thead>
                                 <?php $i=1; ?>
                                 @foreach($filial as $fil)
                                 <tbody>
                                    <tr>
                                       <td>{{$i++}}</td>
                                       <td>{{$fil->filial_name}} </td>
                                       <td>{{$fil->filial_mfo}}</td>
                                       <td>
                                           <form action="/filial/{{$fil->id}}/edit" method="GET">
                                               @csrf
                                           <button type="submit" class="btn btn-warning">Edit</button>
                                           </form>
                                       </td>
                                       <td>
                                           <form action="{{route('filial.destroy',['filial'=>$fil->id])}}" method="POST">
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
