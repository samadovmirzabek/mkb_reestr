@extends('layouts.admin')
@section('content')
<div style="margin-right:30px; margin-top:30px">

<table class="table align-middle mb-0 bg-white " >
  <thead class="bg-light">
    <tr>
      <th style="width:5px;">№</th>
      <th >Departamentlar Nomi </th>
      <th>Shtatda</th>
      <th>Amalda </th>
      <th>Vakant </th>
      <th>        </th>
      <th>        </th>
      @foreach($texnikas as $tex)
            <th>{{ $tex->name }}  </th>
      @endforeach
     </tr>   
  </thead>
  <tbody>
    <?php $i=1; ?>
        @foreach($dep as $d)
            <tr>
            <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                      <p class="fw-bold mb-1"> {{ $i++ }}</p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                      <p > {{ $d->dep_name }}</p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                      <p> {{ $d->shatatda }}</p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                      <p> {{ $d->amalda }}</p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                      <p> {{ ($d -> shatatda) - ($d -> amalda) }}</p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                      <p> </p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                      <p> </p>
                  </div>
                </div>
              </td>
                @foreach($texnikas as $t)
                    <td>
                        <a href="{{route('dep_bul.export',[
                          'departament_id'=>$d->id,
                          'texnika_id'=>$t->id
                          ])}}" >{{ $d->electronica($t->id) }}</a>
                    </td>
                @endforeach
            </tr>
        @endforeach
        <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                      <p >JAMI TEXNIKALAR SONI</p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                      <p ></p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                      <p ></p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                      <p ></p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                      <p ></p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                      <p ></p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                      <p class="fw-bold mb-1"></p>
                  </div>
                </div>
              </td>
            @foreach($texnikas as $t)
                <td>
                    <p>{{ $t->soni($t->id) }}</p>
                </td>
            @endforeach
        </tr>
      </tbody>
    </table>

</div>

@endsection

        