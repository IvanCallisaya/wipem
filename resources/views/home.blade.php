@extends('master')

@section('content')
<div id="app">
  <div class="container-fluid gap-30 embed-responsive embed-responsive-16by9">
    <imagenes />
  </div>

  <div class="clearfix"></div>
  <div class="features">

    <div class="container categoria-formulario">
      <categorias />
    </div>

    <div class="container">

      <div class="clearfix"></div>
      <div class="container">
        <div class="heading-3 gap-50">
          <div class="row sectionTitle text-center">
            <h5>PROYECTOS SOCIALES DESTACADOS</h5>

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
          <h5 class="text-center">EMBAJADORES</h5>
        </div>
        <influencer />
      </div>


    </div>



  </div>

  @endsection