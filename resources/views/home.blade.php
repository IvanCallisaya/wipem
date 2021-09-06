@extends('master')

@section('content')
<div id="app">
  <div class="container-fluid">
    <imagenes />
  </div>

  <div class="clearfix"></div>
  <div class="features">

    <div class="container">
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
          <h5 class="text-center">Empresas Aliadas</h5>
        </div>
        <empresa-carrusel />
      </div>

      <div class="container-fluid mt-20">
        <div class="heading-3 gap-50">
          <h5 class="text-center">Influencers</h5>
        </div>
        <influencer />
      </div>


    </div>


  </div>

  @endsection