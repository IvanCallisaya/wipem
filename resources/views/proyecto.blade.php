@extends('master')

@section('content')

<div id="app">
  <div class="container-fluid">
    <imagenes-proyecto />
  </div>
  <proyecto :proyecto="{{json_encode($proyecto)}}" />

</div>
@endsection('content')