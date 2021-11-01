@extends('master')

@section('content')

<div id="app">
  <div class="container-fluid gap-30">
    <div class="home-slider">
      <imagenes-causas />
    </div>
  </div>
  <section class="gallery-content">
    <div class="container-fluid">
      <causas />
    </div>
  </section>
</div>
@endsection('content')