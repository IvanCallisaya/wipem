<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />


  <title>WIPEM</title>
  <link rel="shortcut icon" type="image/jpg" href="{{asset('images/logo-wipem.png')}}" />
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{asset('css/bootstrap-theme.min.css') }}">
  <link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.min.css') }}" />
  <link rel="stylesheet" href="{{asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{asset('css/theme.css') }}">
  @if (Auth::user() !== null)
  @auth
  <meta name="user-id" content="{{ Auth::user()->email }}">
  @endauth
  @else
  <meta name="user-id" content="">
  @endif
  <link href="https://fonts.cdnfonts.com/css/baloo-thambi-2" rel="stylesheet">


<body>


  <div id="app">
    <header class="header">
      <div class="top-bar">
        <div class="container">
          <div class="row">
            <div class="col-sm-30 logo-cabecera">
              <a class="navbar-brand" href="/"><img src="{{asset('images/logo-wipem.png')}}" class="img-responsive" alt="" /></a>
            </div>
            <div class="col-sm-30">
              <ul>
                <li><a href="/causas/todas">Causas</a></li>
                <li><a href="/">¿Qué es Wipem?</a></li>
                <li><a href="/">Blog</a></li>
              </ul>
              <ul class="nav-login">
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
                <li><a href="">{{ Auth::user()->name }}</a></li>
                @else
                <li><a href="{{ route('login') }}">Iniciar Sesión</a></li>

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
              <p>WIPEM es una plataforma que te conecta con causas y proyectos de todo tipo<br> <br>

                Elige la Causa o el Proyecto que más te motive y que quieras Apoyar<br> <br>

                ¡Cada Boliviano Cuenta!<br> <br>
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
              <p> <a href="https://wa.me/59178046687">78046687</a> / <a href="https://wa.me/59169128218">69128218</a> / <a href="https://wa.me/59177037370">77037370</a> </p>
            </div>
            <div class="f-contact">
              <div class="fc-icon">
                <i class="fa fa-envelope"></i>
              </div>
              <a href="mailto:wipembolivia@gmail.com">
                <p>wipembolivia@gmail.com</p>
              </a>
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
                  <a href="https://www.youtube.com/channel/UCPF8GJpqlggdkdYt4NFvzzA"><i class="fa fa-youtube-play"></i></a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-sm-4 col-md-4">
            <a href="" data-lity>
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
    <whatsapp />
  </div>

  </div>

  <!-- <script src="{{ asset('js/app.js') }}"></script> -->
  <script src="{{ mix('js/manifest.js') }}" defer></script>
  <script src="{{ mix('js/vendor.js') }}" defer></script>
  <script src="{{ mix('js/app.js') }}" defer></script>
  <script src="{{asset('js/jquery-2.1.4.min.js') }}"></script>
  <script src="{{asset('js/bootstrap.min.js') }}"></script>
  <script src="{{asset('js/main.js') }}"></script>
  <script src="{{asset('vendors/waypoint/waypoints.min.js') }}"></script>
  <script src="{{asset('vendors/couterup/jquery.counterup.min.js') }}"></script>
  <script src="{{asset('js/theme.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/node-uuid/1.4.7/uuid.min.js"></script>

</body>

</html>