<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>WIPEM</title>

  <!-- <link rel="stylesheet" href="{{asset('css/all.css') }}" /> -->

  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.min.css') }}" />
  <link rel="stylesheet" href="{{asset('css/jquery.circliful.css') }}" />
  <link rel="stylesheet" href="{{asset('js/lity/lity.min.css') }}" />
  <link rel="stylesheet" href="{{asset('css/style.css') }}" />
  <link rel="stylesheet" href="{{asset('css/bootstrap-theme.min.css') }}">
  <link rel="stylesheet" href="{{asset('vendors/magnific-popup/magnific-popup.css') }}">
  <link rel="stylesheet" href="{{asset('css/theme.css') }}">


<body>

  <div id="app">
    <header class="header">
      <div class="top-bar">
        <div class="container">
          <div class="row">
            <div class="col-sm-30 hidden-xs">
              <a class="navbar-brand" href="./index.html"><img src="{{asset('images/logo-oficial.png')}}" class="img-responsive" alt="" /></a>
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
                <li><a href="{{ route('register') }}">Registrarse</a></li>
                @endif
                @endauth

                @endif
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>

    <div class="container">

    </div>
    @yield('content')


    <footer class="footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4 col-sm-4">
            <div class="widget about">
              <a href="/"><img class="f-logo img-responsive" src="{{asset('images/logo-oficial.png')}}" alt=""></a>
              <p>Rem iplsum dolor amet, consectetuer adipisc gelit diam nonummy nib euismod tincidu laoreet dolore naaliquam erat volutpat euimod To understand bo how we work and see an pages. ....
              </p>
            </div>
          </div>
          <div class="col-md-3 col-sm-3">
            <div class="gap-30"></div>
            <div class="f-contact">
              <div class="fc-icon">
                <i class="fa fa-map-marker"></i>
              </div>
              <p>210 Street . Belgium from the US, Europe</p>
            </div>
            <div class="f-contact">
              <div class="fc-icon">
                <i class="fa fa-phone"></i>
              </div>
              <p>0203 006 1180 &nbsp; / &nbsp; 0203 006 1180</p>
            </div>
            <div class="f-contact">
              <div class="fc-icon">
                <i class="fa fa-envelope"></i>
              </div>
              <p>websroad@gmail.com</p>
            </div>
          </div>
          <div class="col-md-1 col-sm-1">
            <div class="what-we-do">
              <ul>
                <li>
                  <a href="https://www.facebook.com/wipembo"><img src="{{asset('images/facebook.png')}}" class="img-responsive" alt="" /></a>
                </li>
                <li>
                  <a href="https://www.instagram.com/wipembolivia/"><img src="{{asset('images/instagram.png')}}" class="img-responsive" alt="" /></a>
                </li>
                <a href=""><img src="{{asset('images/youtube.png')}}" class="img-responsive" alt="" /></a>
                <li>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-sm-4 col-md-4">
            <a href="https://www.youtube.com/watch?v=bfAzi6D5FpM" data-lity>
              <div class="footer-video">
                <div class="fv-inner">
                  <i class="fa fa-youtube-play"></i>
                  <h4>We Can Create an Emotional<br>Response in the Viewer</h4>
                  <p>Awareness or Raise Funds</p>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </footer>


  </div>


  <!-- jQuery -->
  <script type="application/javascript" src="{{asset('js/app.js') }}"></script>
  <script src="{{asset('js/jquery.min.js') }}"></script>
  <script src="{{asset('js/bootstrap.min.js') }}"></script>
  <script src="{{asset('js/isotope.pkgd.js') }}"></script>
  <script src="{{asset('js/jquery.downCount.js') }}"></script>
  <script src="{{asset('js/jquery.circliful.min.js') }}"></script>
  <script src="{{asset('js/jflickrfeed.min.js') }}"></script>
  <script src="{{asset('js/main.js') }}"></script>

  <!--Magnific Popup-->
  <script src="{{asset('vendors/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
  <!--Owl Carousel-->
  <script src="{{asset('js/slick.min.js') }}"></script>
  <script src="{{asset('vendors/owl.carousel/owl.carousel.min.js') }}"></script>

  <!--CounterUp-->
  <script src="{{asset('vendors/couterup/jquery.counterup.min.js') }}"></script>
  <!--WayPoints-->
  <script src="{{asset('vendors/waypoint/waypoints.min.js') }}"></script>
  <!--Theme Script-->
  <script src="{{asset('js/theme.js') }}"></script>



</body>

</html>