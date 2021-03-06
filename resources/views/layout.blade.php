<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title> LIA - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="Sistema para el control de notas escolares" name="description" />
    <meta content="Jorge Hernandez" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="{{ASSET('images/favicon.ico')}}">

    <!-- App css -->
    
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/icons.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('modernizr.min.js')}}"></script>
</head>

<body>
    <header id="topnav">
        <div class="topbar-main">
            <div class="container-fluid">
                <div class="logo hide-phone">
                    <a href="index.html" class="logo">

                        <span class="logo-large">
                            {{Auth::User()->institucion->abr}}
                            

                        </span>
                        <!--<img src="images/logo_sm.png" alt="" height="24" class="logo-sm">-->
                    </a>

                </div>
                <div class="menu-extras topbar-custom">
                    <ul class="list-inline float-right mb-0">
                        <li class="menu-item list-inline-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle nav-link">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>

                        <li class="list-inline-item dropdown notification-list ">
                            <a class="nav-link dropdown-toggle waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                aria-expanded="false">
                                <img src="images/icons/user.png" alt="user" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="text-overflow">
                                        <small class="text-white">
                                            {{Auth::User()->tipo->tipo}}
                                        </small>
                                    </h5>
                                </div>

                                <!-- item-->
                                <!--  <a href="javascript:void(0);" class="dropdown-item notify-item">
              <i class="mdi mdi-account-star-variant"></i> <span>Profile</span>
            </a>-->

                                <!-- item-->

                            </div>
                        </li>

                    </ul>
                    <ul class="list-inline menu-left mb-0 col-6 col-sm-4 col-md-4">
                        <li class=" app-search ">

                            <form role="search" class="">
                                <input type="text" placeholder="Buscar..." class="form-control col-12 col-sm-12 col-md-12">
                                <a href="">
                                    <i class="fa fa-search"></i>
                                </a>
                            </form>

                        </li>
                    </ul>
                </div>
                <!-- end menu-extras -->

                <div class="clearfix"></div>

            </div>
            <!-- end container -->
        </div>
        <!-- end topbar-main -->

        <div class="navbar-custom">
            <div class="container-fluid">
                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">



                        <li class="has-submenu">
                            <a href="../main/">
                                <i class="ti-home"></i>Inicio</a>
                        </li>

                        <li class="has-submenu">
                            <a href="../alumnos/">
                                <i class="  ti-user  "></i>Alumnos</a>
                            <ul class="submenu">
                                <li>
                                    <a href="../alumnos/">Agregar/Editar</a>
                                </li>
                                <li>
                                    <a href="../listados/asignar.php">Asignar Sección</a>
                                </li>
                                <li>
                                    <a href="../listados/">Ver Listados</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#">
                                <i class="ti-clipboard"></i>Calificaciones</a>
                            <ul class="submenu">
                                <li>
                                    <a href="../notas/">Por Alumno</a>
                                </li>
                                <li>
                                    <a href="../notas/grado.php">Por Grado</a>
                                </li>
                                <li>
                                    <a href="../notas/cuadro.php">Cuadro de Honor</a>
                                </li>
                                <li>
                                    <a href="../notas/cp.php">Con Clases Perdidas</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="#">
                                <i class="  ti-settings  "></i>Ajustes</a>
                            <ul class="submenu">
                                <li>
                                    <a href="../profesores/">Profesores</a>
                                </li>
                                <li>
                                    <a href="../materias/">Materias</a>
                                </li>
                                <li>
                                    <a href="../grados/">Grados</a>
                                </li>
                                <li>
                                    <a href="../asignarmaterias/">Asignar Materias</a>
                                </li>
                                <li>
                                    <a href="../asesores/">Asesores</a>
                                </li>
                                <li>
                                    <a href="../usuariosprofesores/">Cuentas Profesores</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-submenu">
                            <a href="{{route('logout')}}">
                                <i class=" ti-power-off "></i>Salir</a>
                        </li>

                    </ul>

                    <!-- End navigation menu -->
                </div>
                <!-- end #navigation -->
            </div>
            <!-- end container -->
        </div>
        <!-- end navbar-custom -->
    </header>
    <!-- End Navigation Bar-->



    <div class="wrapper">
        <div class="head">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-light">
                        <b>Inicio</b>
                        <small>
                            <small>> Perfil Alumnos</small>
                        </small>
                    </h2>
                </div>
                <div class="col-md-12">
                    <p class="text-light">Accede a tus calificaciones, entrega tareas y revisa tus pagos desde donde quieras</p>
                </div>
            </div>
        </div>
        <div class="container-fluid">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group pull-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item">
                                    <a href="../">abrcole</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="./">Calificaciones</a>
                                </li>
                                <li class="breadcrumb-item active">Por Alumno</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Inicio</h4>
                    </div>
                </div>
            </div>
            <!-- end page title end breadcrumb -->
            <div class="row">
                <div class="card-box">
                    <div class="col-md-12">
                        @yield('content')
                    </div>
                </div>

            </div>
        </div>
        <!-- end container -->
    </div>
    <!-- end wrapper -->


    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    LIA - Gestion & Desarrollo: Jorge Hernández
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->
    <!-- jQuery  -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <!-- Popper for Bootstrap -->
    <!-- Tether for Bootstrap -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/waves.js')}}"></script>
    <script src="{{asset('js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('js/jquery.scrollTo.min.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('js/jquery.core.js')}}"></script>
    <script src="{{asset('js/jquery.app.js')}}"></script>
    <!--<script src="{{asset('js/jquery.menu.js')}}"></script>-->

</body>

</html>