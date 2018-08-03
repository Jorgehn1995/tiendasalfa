<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <title>AlfaPOS :. @yield('title')</title>

    <link href="{{asset('tema2/plugins/sweet-alert/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('tema2/plugins/tablesaw/css/tablesaw.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('tema2/plugins/switchery/switchery.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('tema2/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('tema2/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('tema2/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('tema2/plugins/morris/morris.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('tema2/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('tema2/css/icons.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('tema2/css/style.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('tema2/js/modernizr.min.js')}}"></script>


</head>


<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <div class="text-center">
                    <a href="index.html" class="logo"><i class="ti-shopping-cart"></i> <span>AlfaPOS</span></a>
                </div>
            </div>

            <!-- Button mobile view to collapse sidebar menu -->
            <nav class="navbar-custom">

                <ul class="list-inline float-right mb-0">

                    <li class="list-inline-item notification-list hide-phone">
                        <a class="nav-link waves-light waves-effect" href="#" id="btn-fullscreen">
                                <i class="mdi mdi-crop-free noti-icon"></i>
                            </a>
                    </li>

                    
                </ul>
                <ul class="list-inline menu-left mb-0">
                    <li class="float-left">
                        <button class="button-menu-mobile open-left waves-light waves-effect">
                                <i class="mdi mdi-menu"></i>
                            </button>
                    </li>
                    <li class="hide-phone app-search">
                        <form role="search" class="">
                            <input type="text" placeholder="Search..." class="form-control">
                            <a href=""><i class="fa fa-search"></i></a>
                        </form>
                    </li>
                </ul>

            </nav>

        </div>
        <!-- Top Bar End -->


        <!-- ========== Left Sidebar Start ========== -->

        <div class="left side-menu">
            <div class="sidebar-inner slimscrollleft">
                <!--- Divider -->
                <div id="sidebar-menu">
                    <ul>
                        <li class="menu-title">Principal</li>
                        <li>
                            <a href="#" class="waves-effect waves-primary"><i class="ti-home"></i><span> Inicio </span></a>
                        </li>
                        <li>
                            <a href="{{route('productos.index')}}" class="waves-effect waves-primary"><i class=" ti-dropbox"></i><span> Productos </span></a>
                        </li>
                       <!-- <li>
                            <a href="#" class="waves-effect waves-primary"><i class=" ti-split-h"></i><span> Existencias </span></a>
                        </li>
                        <li>
                            <a href="#" class="waves-effect waves-primary"><i class=" ti-shopping-cart-full"></i><span> Vender </span></a>
                        </li>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect waves-primary"><i class=" ti-bar-chart"></i> <span> Reportes </span>
                                    <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="#">Ventas</a>
                                </li>
                                <li>
                                    <a href="#">Productos</a>
                                </li>
                                <li>
                                    <a href="#">Estadisticas</a>
                                </li>
                                <li>
                                    <a href="#">Mas Vendido</a>
                                </li>
                                <li>
                                    <a href="#">Perecedero</a>
                                </li>
                            </ul>
                        </li>
                        
                        <li>
                            <a href="#" class="waves-effect waves-primary"><i class=" ti-settings"></i><span> Ajustes </span></a>
                        </li>-->
                        <li>
                            <a href="{{route('sucursales.index')}}" class="waves-effect waves-primary"><i class=" ti-map-alt"></i><span> Sucursales </span></a>
                        </li>
                        <li>
                            <a href="{{route('usuarios.index')}}" class="waves-effect waves-primary"><i class=" ti-user"></i><span> Usuarios </span></a>
                        </li>
                        <li>
                            <a href="{{route('logout')}}" class="waves-effect waves-primary"><i class=" ti-power-off"></i><span> Salir </span></a>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Left Sidebar End -->




        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container-fluid">

                    <!-- Page-Title 
                    <div class="row ">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <h4 class="page-title">@yield('title')</h4>
                                <ol class="breadcrumb float-right hide-phone">
                                    <li class="breadcrumb-item"><a href="{{route('logincheck')}}">AlfaPOS</a></li>
                                    <li class="breadcrumb-item active">@yield('title')</li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>-->


                    <div class="row">
                        <div class="col-md-12">
    @include('flash::message')
                        </div>
                    </div>
                    <div class="row">
                        @yield('content')

                    </div>




                </div>
                <!-- end container -->
            </div>
            <!-- end content -->

            <footer class="footer">
                2014 - 2018 © LIA Solutions Center - liasolutionscenter.com
            </footer>

        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->


        <!-- Right Sidebar -->
        <div class="side-bar right-bar">
            <div class="">
                <ul class="nav nav-tabs tabs-bordered nav-justified">
                    <li class="nav-item">
                        <a href="#home-2" class="nav-link active" data-toggle="tab" aria-expanded="false">
                                Actualizaciones
                            </a>
                    </li>
                    <li class="nav-item">
                        <a href="#messages-2" class="nav-link" data-toggle="tab" aria-expanded="true">
                                Ajustes Rápidos
                            </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="home-2">
                        <div class="timeline-2">
                            <div class="time-item">
                                <div class="item-info">
                                    <small class="text-muted">5 minutes ago</small>
                                    <p><strong><a href="#" class="text-info">John Doe</a></strong> Uploaded a photo <strong>"DSC000586.jpg"</strong></p>
                                </div>
                            </div>

                            <div class="time-item">
                                <div class="item-info">
                                    <small class="text-muted">30 minutes ago</small>
                                    <p><a href="" class="text-info">Lorem</a> commented your post.</p>
                                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                </div>
                            </div>

                            <div class="time-item">
                                <div class="item-info">
                                    <small class="text-muted">59 minutes ago</small>
                                    <p><a href="" class="text-info">Jessi</a> attended a meeting with<a href="#" class="text-success">John Doe</a>.</p>
                                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                </div>
                            </div>

                            <div class="time-item">
                                <div class="item-info">
                                    <small class="text-muted">1 hour ago</small>
                                    <p><strong><a href="#" class="text-info">John Doe</a></strong>Uploaded 2 new photos</p>
                                </div>
                            </div>

                            <div class="time-item">
                                <div class="item-info">
                                    <small class="text-muted">3 hours ago</small>
                                    <p><a href="" class="text-info">Lorem</a> commented your post.</p>
                                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                </div>
                            </div>

                            <div class="time-item">
                                <div class="item-info">
                                    <small class="text-muted">5 hours ago</small>
                                    <p><a href="" class="text-info">Jessi</a> attended a meeting with<a href="#" class="text-success">John Doe</a>.</p>
                                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="tab-pane" id="messages-2">

                        <div class="row m-t-20">
                            <div class="col-8">
                                <h5 class="m-0 font-15">Notifications</h5>
                                <p class="text-muted m-b-0"><small>Do you need them?</small></p>
                            </div>
                            <div class="col-4 text-right">
                                <input type="checkbox" checked data-plugin="switchery" data-color="#3bafda" data-size="small" />
                            </div>
                        </div>

                        <div class="row m-t-20">
                            <div class="col-8">
                                <h5 class="m-0 font-15">API Access</h5>
                                <p class="m-b-0 text-muted"><small>Enable/Disable access</small></p>
                            </div>
                            <div class="col-4 text-right">
                                <input type="checkbox" checked data-plugin="switchery" data-color="#3bafda" data-size="small" />
                            </div>
                        </div>

                        <div class="row m-t-20">
                            <div class="col-8">
                                <h5 class="m-0 font-15">Auto Updates</h5>
                                <p class="m-b-0 text-muted"><small>Keep up to date</small></p>
                            </div>
                            <div class="col-4 text-right">
                                <input type="checkbox" checked data-plugin="switchery" data-color="#3bafda" data-size="small" />
                            </div>
                        </div>

                        <div class="row m-t-20">
                            <div class="col-8">
                                <h5 class="m-0 font-15">Online Status</h5>
                                <p class="m-b-0 text-muted"><small>Show your status to all</small></p>
                            </div>
                            <div class="col-4 text-right">
                                <input type="checkbox" checked data-plugin="switchery" data-color="#3bafda" data-size="small" />
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- /Right-bar -->

    </div>
    <!-- END wrapper -->



    <script>
        var resizefunc = [];
    </script>

    <!-- Plugins  -->

    <script src="{{asset('tema2/js/jquery.min.js')}}"></script>
    <script src="{{asset('tema2/js/popper.min.js')}}"></script>
    <!-- Popper for Bootstrap -->

    <script src="{{asset('tema2/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('tema2/js/detect.js')}}"></script>
    <script src="{{asset('tema2/js/fastclick.js')}}"></script>
    <script src="{{asset('tema2/js/jquery.slimscroll.js')}}"></script>

    <!-- Datatables -->
    <script src="{{asset('tema2/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('tema2/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('tema2/plugins/datatables/accent-neutralise.js')}}"></script>

    <!-- Tablesaw js -->
    <script src="{{asset('tema2/plugins/tablesaw/js/tablesaw.js')}}"></script>
    <script src="{{asset('tema2/plugins/tablesaw/js/tablesaw-init.js')}}"></script>

    <!-- Sweet Alert Js  -->
    <script src="{{asset('tema2/plugins/sweet-alert/sweetalert2.min.js')}}"></script>


    <!-- Notification js -->
    <script src="{{asset('tema2/plugins/notifyjs/dist/notify.min.js')}}"></script>
    <script src="{{asset('tema2/plugins/notifications/notify-metro.js')}}"></script>



    <!-- Buttons examples -->
    <script src="{{asset('tema2/plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('tema2/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('tema2/plugins/datatables/jszip.min.js')}}"></script>
    <script src="{{asset('tema2/plugins/datatables/pdfmake.min.js')}}"></script>
    <script src="{{asset('tema2/plugins/datatables/vfs_fonts.js')}}"></script>
    <script src="{{asset('tema2/plugins/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('tema2/plugins/datatables/buttons.print.min.js')}}"></script>


    <script src="{{asset('tema2/js/waves.js')}}"></script>
    <script src="{{asset('tema2/js/wow.min.js')}}"></script>
    <script src="{{asset('tema2/js/jquery.nicescroll.js')}}"></script>
    <script src="{{asset('tema2/js/jquery.scrollTo.min.js')}}"></script>
    <script src="{{asset('tema2/plugins/switchery/switchery.min.js')}}"></script>


    <!-- Custom main Js -->
    <script src="{{asset('tema2/js/jquery.core.js')}}"></script>
    <script src="{{asset('tema2/js/jquery.app.js')}}"></script>

    <script src="{{asset('tema2/js/funciones.js')}}"></script>
</body>

</html>