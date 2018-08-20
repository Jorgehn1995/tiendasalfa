@extends('admin.layout') 
@section('title', "Reporte Ventas del Día") 
@section('content')
<div class="col-md-12 m-t-15">
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="panel-body">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h3 class="text-right"><i class="ti-shopping-cart"></i>AlfaPOS</h3>
                        </div>
                        <div class="pull-right">
                            <h6>Reporte # <br>
                                <strong>{{date("Y-m-d h.i.s")}}</strong>
                            </h6>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <p class="text-muted ">Caducidad de Productos</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-6  col-md-6">
    <div class="widget-bg-color-icon card-box">
        <div class="bg-icon bg-icon-danger pull-left">
            <i class="  ti-na text-success"></i>
        </div>
        <div class="text-right">
        <h3 class="text-dark m-t-10"><b class="counter" id="ncaducados">{{count($vencidos)}}</b></h3>
            <p class="text-muted mb-0">Vencidos</p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="col-lg-6  col-md-6">
    <div class="widget-bg-color-icon card-box">
        <div class="bg-icon bg-icon-warning pull-left">
            <i class="  ti-alert text-success"></i>
        </div>
        <div class="text-right">
            <h3 class="text-dark m-t-10"><b class="counter" id="ncaducados">{{count($porvencer)}}</b></h3>
            <p class="text-muted mb-0">Por Vencer</p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="col-md-12  col-print-6">
    <div class="portlet">
        <!-- /primary heading -->
        <div class="portlet-heading">
            <h3 class="portlet-title text-dark"> Productos Vencidos</h3>
            <div class="portlet-widgets">
                <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                <span class="divider"></span>
                <a data-toggle="collapse" data-parent="#accordion1" href="#prttop10"><i class="ion-minus-round"></i></a>

            </div>
            <div class="clearfix"></div>
        </div>
        <div id="prttop10" class="panel-collapse collapse show">
            <div class="portlet-body">
                <table class="table  table-hover ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>barra</th>
                            <th>Nombre</th>
                            <th>Existencias</th>
                            <th>Vencimiento</th>
                        </tr>
                    </thead>
                    <tbody id="mvendidas">
                        @foreach($vencidos as $vencido)
                        <tr>
                            <td>{{$vencido->idproducto}}</td>
                            <td><small><small><p style="font-size:11pt ; font-family: IDAutomationHC39M">({{$vencido->barra}})</p></small></small></td>
                            <td>{{$vencido->nombre}}</td>
                            
                            <td>{{array_sum(array_column($vencido->existencias->all(), 'existencia'))}}</td>
                            <td>{{date("d/m/Y",strtotime($vencido->caducidad))}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /Portlet -->
</div>
<div class="col-6 col-md-12  col-print-6">
        <div class="portlet">
            <!-- /primary heading -->
            <div class="portlet-heading">
                <h3 class="portlet-title text-dark"> Productos Por Vencer</h3>
                <div class="portlet-widgets">
                    <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                    <span class="divider"></span>
                    <a data-toggle="collapse" data-parent="#accordion1" href="#prttop10"><i class="ion-minus-round"></i></a>
    
                </div>
                <div class="clearfix"></div>
            </div>
            <div id="prttop10" class="panel-collapse collapse show">
                <div class="portlet-body">
                    <table class="table  table-hover ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>barra</th>
                                <th>Nombre</th>
                                <th>Existencias</th>
                                <th>Vencimiento</th>
                            </tr>
                        </thead>
                        <tbody id="mvendidas">
                                @foreach($porvencer as $vencido)
                                <tr>
                                    <td>{{$vencido->idproducto}}</td>
                                    <td><small><small><p style="font-size:11pt ; font-family: IDAutomationHC39M">({{$vencido->barra}})</p></small></small></td>
                                    <td>{{$vencido->nombre}}</td>
                                    
                                    <td>{{array_sum(array_column($vencido->existencias->all(), 'existencia'))}}</td>
                                    <td>{{date("d/m/Y",strtotime($vencido->caducidad))}}</td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /Portlet -->
    </div>
<div class="col-12">
    <div class="card-box">
        <div class="d-print-none">
            <div class="text-right">
                <a href="javascript:window.print()" class="btn btn-dark waves-effect waves-light"><i class="fa fa-print"></i></a>

            </div>
        </div>
    </div>
</div>
@endsection
 
@section("scripts")
<script src="{{asset('tema2/plugins/moment/moment.js')}}"></script>
<script src="{{asset('tema2/plugins/moment/src/locale/es.js')}}"></script>
<script>
    counterup();
    $('#reportrange span').html(moment().format('MMMM D, YYYY'));

</script>
@endsection