<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>WIPEM</title>
  <link rel="shortcut icon" type="image/jpg" href="{{asset('images/logo-wipem.png')}}" />
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{asset('css/bootstrap-theme.min.css') }}">
  <link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.min.css') }}" />
  <link rel="stylesheet" href="{{asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{asset('css/theme.css') }}">
  <link href="https://fonts.cdnfonts.com/css/baloo-thambi-2" rel="stylesheet">


<body>

  <div id="app">
    <header class="header">
      <div class="top-bar">
        <div class="container">
          <div class="row">
            <div class="col-sm-30 logo-cabecera">
              <a class="navbar-brand" href="./index.html"><img src="{{asset('images/logo-wipem.png')}}" class="img-responsive" alt="" /></a>
            </div>
            <div class="col-sm-30">
              <ul>
                <li><a href="/">Inicio</a></li>
                <li><a href="/causas/0">Causas</a></li>
                <li><a href="/">Contacto</a></li>
                <li><a href="/">Sobre Nosotros</a></li>

                @if (Route::has('login'))

                @auth
                <li>
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                    Salir
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
                  </a>
                </li>

                @else
                <li><a href="{{ route('login') }}">Iniciar Sesión</a></li>

                @if (Route::has('register'))
                <li><a href="/registrarse">Registrarse</a></li>
                @endif
                @endauth

                @endif
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>

    @yield('content')


    <footer class="footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4 col-sm-4">
            <div class="widget about">
              <a href="/"><img class="f-logo img-responsive" src="{{asset('images/logo-oficial.png')}}" alt=""></a>
              <p>¡WIPEM es una plataforma que te conecta con causas y proyectos de todo tipo!<br> <br>

                Identifica la causa o proyecto que más te motive y y tengas la posibilidad de apoyar<br> <br>

                ¡Cada boliviano cuenta!<br> <br>
              </p>
            </div>
          </div>
          <div class="col-md-3 col-sm-3">
            <div class="gap-30"></div>
            <div class="f-contact">
              <div class="fc-icon">
                <i class="fa fa-map-marker"></i>
              </div>
              <p>Tercer Anillo Interno, Pasaje Landivar Edif. Palma de Mallorca Dpto. 1</p>
            </div>
            <div class="f-contact">
              <div class="fc-icon">
                <i class="fa fa-phone"></i>
              </div>
              <p>78046687 / 69128218 / 770337370</p>
            </div>
            <div class="f-contact">
              <div class="fc-icon">
                <i class="fa fa-envelope"></i>
              </div>
              <p>wipembolivia@gmail.com</p>
            </div>
          </div>
          <div class="col-md-1 col-sm-1">
            <div class="what-we-do">
              <ul>
                <li>
                  <a href="https://www.facebook.com/wipembo"><i class="fa fa-facebook-square"></i></a>
                </li>
                <li>
                  <a href="https://www.instagram.com/wipembolivia/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </li>
                <li>
                  <a href=""><i class="fa fa-youtube-play"></i></a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-sm-4 col-md-4">
            <a href="https://www.youtube.com/watch?v=bfAzi6D5FpM" data-lity>
              <div class="footer-video">
                <div class="fv-inner">
                  <i class="fa fa-youtube-play"></i>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </footer>
  </div>
  </div>

  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{asset('js/bootstrap.min.js') }}"></script>
  <script src="{{asset('js/jquery.min.js') }}"></script>
  <script src="{{asset('js/main.js') }}"></script>
  <script src="{{asset('vendors/waypoint/waypoints.min.js') }}"></script>
  <script src="{{asset('vendors/couterup/jquery.counterup.min.js') }}"></script>
  <script src="{{asset('js/theme.js') }}"></script>

</body>

</html>