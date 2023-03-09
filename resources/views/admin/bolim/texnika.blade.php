@extends('layouts.admin')
@section('content')
<div style="margin-right:30px; margin-top:30px">

<table class="table align-middle mb-0 bg-white " >
  <thead class="bg-light">
    <tr>
      <th>№</th>
      <th >Bo'limlartlar Nomi </th>
      <th>Shtatda</th>
      <th>Amalda </th>
      <th>Vakant </th>
      @foreach($texnikas as $tex)
            <th>{{ $tex->name }}  </th>
      @endforeach
     </tr>   
  </thead>
  <tbody>
    <?php $i=1; ?>
        @foreach($bolim as $b)
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
                      <p > {{ $b->dep_name }}</p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                      <p> {{ $b->shatatda }}</p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                      <p> {{ $b->amalda }}</p>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                      <p> {{ ($b -> shatatda) - ($b -> amalda) }}</p>
                  </div>
                </div>
              </td>
              <?php $filial_id = $filial_id; ?>
                @foreach($texnikas as $t)
                    <td>
                        <a href="{{route('search3',[
                                    'filial_id'=>$filial_id,
                                    'bolim_id'=>$b->id,
                                    'texnika_id'=>$t->id])}}" >{{ $b->electronica($t->id) }}</a>
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

        