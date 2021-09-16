@extends('master')

@section('content')

<div class="container">
  <registrar />

</div>
<div class="inner-content">
  <div class="container">
<div class="container pie-formulario col-md-12">
  <div class="col-md-6 text-center">
    <p>¿Ya tienes una cuenta?</p>
  </div>
  <div class="col-md-6 text-center">
    <a href="/login">Iniciar Sesión</a>
  </div>
  <div class="col-md-12 text-center">
    <p>Registrarse con</p>
  </div>
  <div class="col-md-12 text-center">
    <ul>
      <li>
        <a href=" {{ route('login.facebook') }} "
          ><img
            src="images/icons/facebook.png"
            class="img-responsive"
            alt=""
        /></a>
      </li>
      <li>
        <a href=" {{ route('login.google') }} "
          ><img
            src="images/icons/google.png"
            class="img-responsive"
            alt=""
        /></a>
      </li>
    </ul>
  </div>
  </div>
  </div>
</div>

@endsection('content')