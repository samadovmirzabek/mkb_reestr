<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="/assets/img/logomk.jpg">
         <title>MIKROKREDITBANK</title>
         @include('admin.partials.css')
    </head>
    <body >
        <div class="main-wrapper">
        <div class="page-wrapper" style="margin-left: 5%;margin-right:5%;">
            <div class="content container-fluid">
               <div class="page-header " >
                  <div class="row">
                     <div class="col-sm-3"> <img src="/assets/img/logomkb.jpg" alt="Logo" width="250" height="50"/> </div>
                     <div class="col-sm-6" style="text-align:center; font-size:24px; margin-top:10px;"><p>MKBANK BARCHA KOMPYUTER TEXNIKALAR QIDIRUV TIZIMI!</p></div>
                     <div class="col-sm-3">
                        <div lass="btn_middle" style="margin-left: 80%; margin-top:5px;">
                           <a href="{{route('home')}}" class="btn btn-primary ">Admin</a>
                        </div>
                     </div>
                  </div>
               </div>
                <div class="row">
                    <div class="col-md-12">
                       <div class="card">
                          {{-- <div class="card-header" style="text-align:center;">
                             <h5 class="card-title">MIKROKREDIT BANK BARCHA ELEKTRON TEXNIKALR SAHIFASI</h5>
                          </div> --}}
                          <div class="card-body">
                             <form action="{{ route('search') }}" method="POST">
                                @csrf
                                <div class="row" id="add_form">
                                   <div class="col-md-6">
                                      <div class="form-group">
                                         <label>Viloyat nomi </label>
                                         <select class="form-control form-control-lg" name="region_id" id="region" required>
                                            <option value="" disabled selected hidden></option>
                                                @isset($region)
                                                 @foreach($region as $key => $value)
                                                 <option  value="{{ $value->id }}">{{ $value->region_name }}</option>
                                                 @endforeach
                                                 @endisset

                                         </select>
                                      </div>
                                   </div>
                                    <div class="col-md-6" id="for_filial">
                                        <div class="form-group">
                                           <label>Filial nomi </label>
                                           <input type="text" class="form-control form-control-lg" name="filial_name" disabled/>
                                        </div>
                                     </div>


                                     <div class="col-md-6" style="display: none" id="filial">
                                        <div class="form-group">
                                           <label id="add_select"> Filialar nomi </label>
                                           <select class="form-control form-control-sm stil" name="filial_id" id="place_dist" required>
                                            <option value="" disabled selected hidden id="add_option"></option>
                                         </select>
                                        </div>
                                     </div>
                                     <div class="col-md-6" style="display: none" id="dep">
                                        <div class="form-group">
                                           <label>Departament nomi </label>
                                           <select class="select" name="dep_id" >
                                              <option value="" disabled selected hidden></option>
                                                  @isset($dep)
                                                   @foreach($dep as $key => $value)
                                                   <option value="{{ $value->id }}">{{ $value->dep_name }}</option>
                                                   @endforeach
                                                   @endisset

                                           </select>
                                        </div>
                                     </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                           <label>Texnikalar toifasi </label>
                                           <select class="form-control form-control-lg" name="texnika_id" required>
                                              <option value="" disabled selected hidden></option>
                                                  @isset($texnika)
                                                   @foreach($texnika as $key => $value)
                                                   <option value="{{ $value->id }}">{{ $value->name }}
                                                   </option>
                                                   @endforeach
                                                   @endisset

                                           </select>
                                        </div>
                                     </div>
                                </div>
                                <div class="text-right">
                                 <a href="/home"><button type="button" class="btn btn-outline-primary">Tozalash</button></a>

                                   <button type="submit" class="btn btn-outline-primary">Qidirish</button>
                                </div>
                             </form>
                          </div>
                       </div>
                    </div>
                 </div>
                 @if(isset($tex_name))
                <div class="page-header" style="text-align:center;">
                  {{-- <div style="margin-left: 50%;"> --}}
                     {{-- <div class="col-md-12"> --}}
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
                           <a class="btn btn-primary"
                              href="{{route('mkb.export',[
                                    'filial_id'=>$f,
                                    'departament_id'=>$d,
                                    'bolim_id'=>$b,
                                    'texnika_id'=>$t])}}" role="button">Excelga Export</a>
                           @else
                           <h5>Bu so'rovingiz buyicha hali ma'lumot yo'q!</h5>
                           @endif
                        {{-- </div> --}}
                        <a class="btn btn-primary" href="{{ route('dep.texnika') }}" style="margin-left:87%;">Ortga</a>
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
                                       <th>F.I.Sh</th>
                                       @endisset
                                       <th>Invertar raqami </th>
                                       <th>Model </th>
                                       @isset($search[0]->protsessor)
                                       <th>Protsessor </th>
                                       @endisset
                                       @isset($search[0]->ozu)
                                       <th>Operativ xotira</th>
                                       @endisset
                                       @isset($search[0]->tip_sistema)
                                       <th>Sistema Turi</th>
                                       @endisset
                                       @isset($search[0]->storage)
                                       <th>Storage</th>
                                       @endisset
                                       @isset($search[0]->monitor_size)
                                       <th>Monitor_O'lchami</th>
                                       @endisset
                                       @isset($search[0]->monitor_name)
                                       <th>Monitor_Nomi</th>
                                       @endisset
                                       @isset($search[0]->printer_name)
                                       <th>Printer Nomi</th>
                                       @endisset
                                       @isset($search[0]->tip_printer)
                                       <th>Printer Turi</th>
                                       @endisset
                                       <th>Start date </th>
                                       @isset($search[0]->ip)
                                       <th>Ip manzili </th>
                                       @endisset
                                    </tr>
                                 </thead>
                                 <tbody>
                                     @foreach($search as $key => $value)
                                        <tr>
                                          @isset($search)
                                          <td>{{ $key+1 }} </td>
                                          @endisset
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
                                          @isset($value->tip_sistema)
                                          <td>{{ $value->tip_sistema }} </td>
                                          @endisset
                                          @isset($value->storage)
                                          <td>{{ $value->storage }} </td>
                                          @endisset
                                          @isset($value->monitor_size)
                                          <td>{{$value->monitor_size}}</td>
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

         </div>
        </div>


         @include('admin.partials.js')
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
               $( "#add_select" ).after(`<select onchange='getval(this);' class='form-control form-control-lg' name='filial_id' id='place_dist' required>
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
               //  $("#bolim").css("display","none");

               $("#bolim").remove();



               }
               if(response.exists == false) {
                  $("#bolim").remove();
                  $("#dep").css("display","none");
                $( "#dep" ).after(`<div class='col-md-6' id='bolim'>
                        <div class='form-group' >
                           <label>Bolimlar nomi </label>
                           <select class='form-control form-control-sm stil' name='bolim_id'>
                              <option value="" disabled selected hidden></option>
                                  @isset($bolim)
                                   @foreach($bolim as $key => $value)
                                   <option value='{{ $value->id }}'>{{ $value->name }}
                                   </option>
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
        </body>
</html>
