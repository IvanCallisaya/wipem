<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Wipem | Dashboard</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../css/app.css" </head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper" id="app">



    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <aside class="main-sidebar sidebar-light-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="/img/logo.png" alt="Wipem Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Wipem</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <router-link to="/dashboard" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                  <i class="right fas fa-angle-left"></i>
                </p>
              </router-link>
            </li>


            <li class="nav-item">
              <router-link to="/ongs" class="nav-link">
                <i class="nav-icon fas fa-hands-helping"></i>
                <p>
                  ONGS
                </p>
              </router-link>
            </li>
            <li class="nav-item">
              <a href="pages/gallery.html" class="nav-link">
                <i class="nav-icon fas fa-align-justify"></i>
                <p>
                  Proyectos
                </p>
              </a>
            </li>
            <li class="nav-item">
              <router-link to="/categoria" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>

                <p>
                  Categorias
                </p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/plan" class="nav-link">
                <i class="nav-icon fas fa-receipt"></i>

                <p>
                  Planes
                </p>
              </router-link>
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="nav-icon fas fa-hands-helping"></i>
                <p>
                  Sponsors
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <router-link :to="{
                    name: 'empresa',
                  }" class="nav-link">
                    <i class="fas fa-building nav-icon"></i>
                    <p>Empresas</p>
                  </router-link>
                </li>
                <li class="nav-item">
                  <router-link :to="{
                    name: 'influencer',
                  }" class="nav-link">
                    <i class="fas fa-users nav-icon"></i>
                    <p>Influencers</p>
                  </router-link>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-power-off"></i>
                <p>
                  Salir
                </p>
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <router-view></router-view>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <script src="../js/app.js"></script>

</body>

</html>