@extends('layouts.admin')
@section('content')
<div style="margin-right:30px; margin-top:30px">

<table class="table align-middle mb-0 bg-white " >
  <thead class="bg-light">
    <tr>
      <th style="width: 10px;">№</th>
      <th>MFO</th>
      <th style="width: 500px;">Filiallar Nomi </th>
      @foreach($texnikas as $tex)
            <th>{{ $tex->name }}  </th>
      @endforeach
     </tr>   
  </thead>
  <tbody>
    <?php  $i=1; ?>
        @foreach($filial as $f)
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
                      <a href="{{ route('dep_bulim',['filial_id'=>$f->id]) }}"> {{ $f->filial_mfo }}</a>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                      <a href="{{ route('dep_bulim',['filial_id'=>$f->id]) }}" > {{ $f->filial_name }}</a>
                  </div>
                </div>
              </td>
              
                @foreach($texnikas as $t)
                    <td>
                        <a href="{{route('filials.texnika',[
                          'filial_id'=>$f->id,
                          'texnika_id'=>$t->id
                          ])}}">
                          {{ $f->electronica($t->id) }}
                        </a>
                    </td>
                @endforeach
            </tr>
        @endforeach
        <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                      <p class="fw-bold mb-1">JAMI TEXNIKALAR SONI</p>
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
              <td>
                <div class="d-flex align-items-center">
                  <div class="ms-3">
                      <p class="fw-bold mb-1"></p>
                  </div>
                </div>
              </td>
                  @foreach($texnikas as $t)
                        <td>
                            <p>{{ $t->electronica($t->id) }}</p>
                        </td>
                  @endforeach
          </tr>
      </tbody>
    </table>

</div>

@endsection

        