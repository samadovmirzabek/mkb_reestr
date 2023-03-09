@extends('layouts.admin')
@section('content')

<div class="row" style="margin-top:30px;margin-right:15px">
    <div class="col-md-12">
       <div class="card">
          <div class="card-header">
             <h5 class="card-title" style="text-align:center">Texnikalarni Qo'shish Sahifasi</h5>
          </div>
          <div class="card-body">
             <form action="{{ route('texnika.store') }}" method="POST">
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
                           <input type="text" class="form-control stil" name="filial_name" required disabled/>
                        </div>
                     </div>

                     <div class="col-md-6" style="display: none" id="filial">
                        <div class="form-group">
                           <label id="add_select"> Filial Nomi  </label>
                           <select class="form-control form-control-sm stil" name="filial_id" id="place_dist" required>
                            <option value="" disabled selected hidden id="add_option"></option>
                         </select>
                        </div>
                     </div>
                     <div class="col-md-6" style="display: none" id="dep">
                        <div class="form-group">
                           <label>Departament Nomi </label>
                           <select class="select stil" name="dep_id">
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
                           <label>Tenika Toifasi </label>
                           <select class="select" name="texnika_id" onchange="getTexnika(this);">
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
                   <button type="submit" class="btn btn-primary">Qo'shish</button>
                </div>
             </form>
          </div>
       </div>
    </div>
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
               //  $("#bolim").css("display","none");

               $("#bolim").remove();



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
        function getTexnika(sel)
        {
         $("#noutbook").remove();
         $("#monoblock").remove();
         $("#printer").remove();
         $("#pc_monitor").remove();
            if(sel.value == 1)
            {

               $( "#add_form" ).after(`<div class='row'  id='noutbook'>
                     <div class='col-md-6'>
                        <div class='form-group'>
                           <label>F.I.SH</label>
                           <input type='text' class='form-control' name='user' required/>
                        </div>
                     </div>
                     <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Inver nomer </label>
                           <input type='text' class='form-control' name='inverta_nomer' required/>
                        </div>
                     </div>
                     <div class='col-md-6'>
                      <div class='form-group'>
                         <label>Model </label>
                         <input type='text' class='form-control' name='model' required/>
                      </div>
                      </div>
                      <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Protsessor </label>
                           <input type='text' class='form-control' name='protsessor' required/>
                        </div>
                     </div>
                     <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Operativ xotira </label>
                           <input type='text' class='form-control' name='ozu' required/>
                        </div>
                     </div>
                     <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Tip sistema </label>
                           <input type='text' class='form-control' name='tip_sistema' required/>
                        </div>
                     </div>
                     <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Year </label>
                           <input type='date' class='form-control' name='year' required/>
                        </div>
                     </div>
                     <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Storage </label>
                           <input type='text' class='form-control' name='storage' />
                        </div>
                     </div>
                     <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Ip manzili</label>
                           <input type='text' class='form-control' name='ip' required/>
                        </div>
                     </div>
                 </div>`);

               //  $("#noutbook").css("display","");
               //  $("#monoblock").css("display","none");
               //  $("#printer").css("display","none");
               //  $("#pc_monitor").css("display","none");

            }
            if(sel.value == 2)
            {
               $( "#add_form" ).after(`<div class='row'  id='monoblock'>
                     <div class='col-md-6'>
                        <div class='form-group'>
                           <label>F.I.Sh</label>
                           <input type='text' class='form-control' name='user' required/>
                        </div>
                     </div>
                     <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Inver nomer </label>
                           <input type='text' class='form-control' name='inverta_nomer' required/>
                        </div>
                     </div>
                     <div class='col-md-6'>
                      <div class='form-group'>
                         <label>Model </label>
                         <input type='text' class='form-control' name='model' required/>
                      </div>
                      </div>
                      <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Protsessor </label>
                           <input type='text' class='form-control' name='protsessor' required/>
                        </div>
                     </div>
                     <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Operativ xotira </label>
                           <input type='text' class='form-control' name='ozu' required/>
                        </div>
                     </div>
                     <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Tip sistema </label>
                           <input type='text' class='form-control' name='tip_sistema' required/>
                        </div>
                     </div>
                     <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Year </label>
                           <input type='date' class='form-control' name='year' required/>
                        </div>
                     </div>
                     <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Storage </label>
                           <input type='text' class='form-control' name='storage'/>
                        </div>
                     </div>
                     <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Ip manzili</label>
                           <input type='text' class='form-control' name='ip' required/>
                        </div>
                     </div>
                 </div>`);

            }
            if(sel.value == 3)
            {
               $( "#add_form" ).after(`<div class='row'  id='printer'>
                     <div class='col-md-6'>
                        <div class='form-group'>
                           <label>F.I.SH</label>
                           <input type='text' class='form-control' name='user' required/>
                        </div>
                     </div>
                    <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Inver nomer </label>
                           <input type='text' class='form-control' name='inverta_nomer' required/>
                        </div>
                     </div>
                     <div class='col-md-6'>
                      <div class='form-group'>
                         <label>Model </label>
                         <input type='text' class='form-control' name='model' required/>
                      </div>
                      </div>
                     <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Printer nomi </label>
                           <input type='text' class='form-control' name='printer_name' required/>
                        </div>
                     </div>
                     <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Year </label>
                           <input type='date' class='form-control' name='year' required/>
                        </div>
                     </div>
                     <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Printer turi </label>
                           <input type='text' class='form-control' name='tip_printer' required/>
                        </div>
                     </div>
                     <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Ip manzili</label>
                           <input type='text' class='form-control' name='ip' required/>
                        </div>
                     </div>
                 </div>`);

            }
            if(sel.value == 4)
            {
               $( "#add_form" ).after(`<div class='row' id='pc_monitor'>
                      <div class='col-md-6'>
                        <div class='form-group'>
                           <label>F.I.SH</label>
                           <input type='text' class='form-control' name='user' required/>
                        </div>
                     </div>
                    <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Inver nomer </label>
                           <input type='text' class='form-control' name='inverta_nomer' required/>
                        </div>
                     </div>
                     <div class='col-md-6'>
                      <div class='form-group'>
                         <label>Model </label>
                         <input type='text' class='form-control' name='model' required/>
                      </div>
                      </div>
                      <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Protsessor </label>
                           <input type='text' class='form-control' name='protsessor' required/>
                        </div>
                     </div>
                     <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Operativ xotira </label>
                           <input type='text' class='form-control' name='ozu' required/>
                        </div>
                     </div>
                     <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Tip sistema </label>
                           <input type='text' class='form-control' name='tip_sistema' required/>
                        </div>
                     </div>
                     <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Year </label>
                           <input type='date' class='form-control' name='year' required/>
                        </div>
                     </div>
                     <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Storage </label>
                           <input type='text' class='form-control' name='storage'/>
                        </div>
                     </div>
                     <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Monitor name </label>
                           <input type='text' class='form-control' name='monitor_name' required/>
                        </div>
                     </div>
                     <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Monitor size </label>
                           <input type='text' class='form-control' name='monitor_size'/>
                        </div>
                     </div>
                     <div class='col-md-6'>
                        <div class='form-group'>
                           <label>Ip manzili</label>
                           <input type='text' class='form-control' name='ip' required/>
                        </div>
                     </div>
                 </div>`);

            }
        }

    </script>
@endsection
