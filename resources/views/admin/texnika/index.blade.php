        @extends('layouts.admin')
        @section('content')
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-md-12">
                       <div class="card">
                       <div class="page-header" style="text-align:center;">
                           <h5 > MIKROKREDIT BANK BARCHA ELEKTRON TEXNIKALAR RO'YXAT SAHIFASI </h5>
                         </div>
                          <div class="card-body">
                             <form action="{{ route('admin.search') }}" method="POST">
                                @csrf
                                <div class="row" id="add_form">
                                   <div class="col-md-6">
                                      <div class="form-group">
                                         <label>Viloyat Nomi</label>
                                         <select class="select" name="region_id" id="region">
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
                                    <div class="col-md-6" id="for_filial">
                                        <div class="form-group">
                                           <label>Filial Nomi </label>
                                           <input type="text" class="form-control form-control-sm stil" name="filial_name" disabled/>
                                        </div>
                                     </div>
                                     <div class="col-md-6" style="display: none" id="filial">
                                        <div class="form-group">
                                           <label id="add_select"> Filial Nomi </label>
                                           <select class="form-control form-control-sm stil" name="filial_id" id="place_dist" required>
                                            <option value="" disabled selected hidden id="add_option"></option>
                                         </select>
                                        </div>
                                     </div>
                                     <div class="col-md-6" style="display: none" id="dep">
                                        <div class="form-group">
                                           <label>Departament Nomi </label>
                                           <select class="select" name="dep_id">
                                              <option value="" disabled selected hidden></option>
                                                  @isset($dep)
                                                   @foreach($dep as $key => $value)
                                                   <option value="{{ $value->id }}">{{ $value->dep_name }}
                                                   </option>
                                                   @endforeach
                                                   @endisset
                  
                                           </select>
                                        </div>
                                     </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                           <label>Texnika Toifasi </label>
                                           <select class="select stil" name="texnika_id">
                                              <option value="" disabled selected hidden></option>
                                                  @isset($texnika)
                                                   @foreach($texnika as $key => $value)
                                                   <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                   @endforeach
                                                   @endisset
                  
                                           </select>
                                        </div>
                                     </div>
                                </div>
                                <div class="text-right">
                                    <a href="{{route('texnika.index')}}"><button type="button" class="btn btn-outline-primary">Tozalash</button></a>
                                   <button type="submit" class="btn btn-primary">Qidirish</button>
                                </div>
                             </form>
                          </div>
                       </div>
                    </div>
                 </div>
                 <div class="page-header" style="text-align:center;">
                  {{-- <div style="margin-left: 50%;"> --}}
                     {{-- <div class="col-md-12"> --}}
                           @if(isset($tex_name))
                        {{-- <div class="d-flex align-items-center"> --}}
                        @if(sizeof($search)>0)
                           <h5>{{isset($search) ? $search[0]->filial->filial_name : "" }}
                               @if(!empty($d))
                               {{isset($search[0]->dep) ? $search[0]->dep->dep_name : ""}}
                               @endif
                               @if(!empty($b))
                                {{isset($search[0]->bolim) ? $search[0]->bolim->name : ""}}
                               @endif
                               {{ isset($tex_name) ? $tex_name->name : ""}}lari</h5>
                        @else
                           <h5>Bu So'rovingiz buyicha hali ma'lumot yo'q!</h5>
                           @endif
                        {{-- </div> --}}
                        @endif
                     {{-- </div> --}}
                  {{-- </div> --}}
               </div>
               @isset($search)

               <div class="row">
                  <div class="col-sm-12">
                     <div class="card">
                        <div class="card-body">
                           <div class="table-responsive">
                              <table class="datatable table table-stripped">
                                 <thead>
                                    <tr>
                                       <th>№</th>
                                       @isset($search[0]->user)
                                       <th>F.I.SH</th>
                                       @endisset
                                       <th>Inverta raqami </th>
                                       <th>Model </th>
                                       @isset($search[0]->protsessor)
                                       <th>Protsessor </th>
                                       @endisset
                                       @isset($search[0]->ozu)
                                       <th>Operativ xotira</th>
                                       @endisset
                                       @isset($search[0]->storage)
                                       <th>Storage</th>
                                       @endisset
                                       @isset($search[0]->monitor_name)
                                       <th>Monitor Nomi</th>
                                       @endisset
                                       @isset($search[0]->printer_name)
                                       <th>Printer Nomi</th>
                                       @endisset
                                       @isset($search[0]->tip_printer)
                                       <th>Printer turi</th>
                                       @endisset
                                       <th>Start date </th>
                                       @isset($search[0]->ip)
                                       <th>Ip manzili</th>
                                       @endisset
                                       <th>EDIT </th>
                                       <th>DELETE</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                     @foreach($search as $key => $value)
                                        <tr>
                                            <td>{{ $key+1 }} </td>
                                            @isset($value->user)
                                            <td>{{ $value->user }} </td>
                                            @endisset
                                            <td>{{ $value->inverta_nomer}} </td>
                                            <td>{{ $value->model}}  </td>
                                            @isset($value->protsessor)
                                            <td>{{ $value->protsessor }} </td>
                                            @endisset
                                            @isset($value->ozu)
                                            <td>{{ $value->ozu }} </td>
                                            @endisset
                                            @isset($value->storage)
                                            <td>{{ $value->storage }} </td>
                                            @endisset
                                            @isset($value->monitor_name)
                                            <td>{{$value->monitor_name}}</td>
                                            @endisset
                                            @isset($value->printer_name)
                                            <td>{{$value->printer_name}}</td>
                                            @endisset
                                            @isset($value->tip_printer)
                                            <td>{{$value->tip_printer}}</td>
                                            @endisset
                                            @isset($value->year)
                                            <td>{{$value->year}}</td>
                                            @endisset
                                            @isset($value->ip)
                                            <td>{{$value->ip}}</td>
                                            @endisset
                                            <td>
                                                <form action="{{route('texnika.edit',['texnika'=>$value->id])}}" method="GET">
                                                   @csrf
                                                    <button type="submit" class="btn btn-warning">EDIT</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{route('texnika.destroy',['texnika'=>$value->id])}}" method="post">
                                                   {{ method_field('DELETE') }}
                                                   @csrf
                                                     <button type="submit" class="btn btn-danger">DELETE</button>
                                                </form>  
                                            </td>
                                        </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                        </div>

                     </div>
                  </div>
               </div>
               @endisset
            </div>
         @endsection
       
   @section('script')   
    <script>
      $("#region").change(function(){
      $("#dep").css("display","none");

            var region_id = $("#region").val();
            var _token   = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
            url: "/get/filial",
            type:"POST",
            data:{
               id: region_id,
               _token: _token
            },
            success:function(response){
               if(response.filial) {
                  
                $("#place_dist").val('');
               $("#for_filial").css("display","none");
               $("#filial").css("display","");
               // array.forEach(response.district => {
               //    $( "#add_option" ).after( "<option style='display: none' value=''></option>" );
               // });
               $(`#place_dist`).remove();
               $( "#add_select" ).after(`<select onchange='getval(this);' class='form-control form-control-sm' name='filial_id' id='place_dist' required>
                                 <option value='' disabled selected hidden id='add_option'></option>
                              </select>`);
               $.each(response.filial, function(index, value){
                  $( "#add_option" ).after(`<option value='${value.id}' id='province_delete'>${value.filial_name}</option>`);
               });

               }
            },
            error: function(error) {
               console.log(error);
            }
            });
        });
        function getval(sel)
        {
            var _token   = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
            url: "/get/dep",
            type:"POST",
            data:{
               id: sel.value,
               _token: _token
            },
            success:function(response){
               if(response.exists == true) {
                  
                $("#dep").css("display","block");
                $("#bolim").remove();


               }
               if(response.exists == false) {
                  
                  $("#dep").css("display","none");
               }

               if(response.exists == false) {
                  $("#bolim").remove();
                  $("#dep").css("display","none");
                $( "#dep" ).after(`<div class='col-md-6' id='bolim'>
                        <div class='form-group' >
                           <label>Bolimlar Nomi </label>
                           <select class='form-control form-control-sm stil' name='bolim_id'>
                              <option value="" disabled selected hidden></option>
                                  @isset($bolim)
                                   @foreach($bolim as $key => $value)
                                   <option value='{{ $value->id }}'>{{ $value->name }}</option>
                                   @endforeach
                                   @endisset

                           </select>
                        </div>
                     </div>`);



                 }

            },
            error: function(error) {
               console.log(error);
            }
            });

        }

    </script>
    @endsection
       