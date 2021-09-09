@extends('master')

@section('content')
<div id="app">
  <div class="container-fluid gap-30">
    <imagenes />
  </div>

  <div class="clearfix"></div>
  <div class="features">

    <div class="container pie-formulario">
      <categorias />
    </div>

    <div class="container">

      <div class="clearfix"></div>
      <div class="container">
        <div class="heading-3 gap-50">
          <div class="row sectionTitle text-center">
            <h5>CAUSAS DESTACADAS</h5>

            <causa-carrusel />
          </div>

        </div>

      </div>

      <div class="container-fluid mt-20">
        <div class="heading-3 gap-50">
          <h5 class="text-center">EMPRESAS ALIADAS</h5>
        </div>
        <empresa-carrusel />
      </div>

      <div class="container-fluid mt-20">
        <div class="heading-3 gap-50">
          <h5 class="text-center">INFLUENCERS</h5>
        </div>
        <influencer />
      </div>


    </div>


  </div>

  @endsection