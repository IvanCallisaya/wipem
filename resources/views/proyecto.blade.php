@extends('master')

@section('content')

<div id="app">
  <div class="container-fluid gap-30">
    <imagenes-proyecto />
  </div>
  <proyecto :proyecto="{{json_encode($proyecto)}}" />

</div>
@endsection('content')