@extends('admin.layout') 
@section('title', "Inicio") 
@section('content')
<div class="col-lg-3 col-md-6">
    <div class="widget-bg-color-icon card-box">
        <div class="bg-icon bg-icon-primary pull-left">
            <i class="  ti-map-alt text-success"></i>
        </div>
        <div class="text-right">
            <h3 class="text-dark m-t-10"><b class="counter" id="nsucursal"></b></h3>
            <p class="text-muted mb-0">Sucursales</p>

        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="col-lg-3 col-md-6">
    <div class="widget-bg-color-icon card-box">
        <div class="bg-icon bg-icon-danger pull-left">
            <i class="ti-money text-success"></i>
        </div>
        <div class="text-right">
            <h3 class="text-dark m-t-10">Q <b class="counter" id="ncostos"></b></h3>
            <p class="text-muted mb-0">Costos/Mes</p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="widget-bg-color-icon card-box">
        <div class="bg-icon bg-icon-success pull-left">
            <i class=" ti-stats-up text-success"></i>
        </div>
        <div class="text-right">
            <h3 class="text-dark m-t-10">Q <b class="counter" id="nganancias"></b></h3>
            <p class="text-muted mb-0">Ganancias/Mes</p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="col-lg-3 col-md-6">
    <div class="widget-bg-color-icon card-box">
        <div class="bg-icon bg-icon-info pull-left">
            <i class=" ti-bag text-success"></i>
        </div>
        <div class="text-right">
            <h3 class="text-dark m-t-10">Q <b class="counter" id="ningresos"></b></h3>
            <p class="text-muted mb-0">Ingresos/Mes</p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="col-lg-6 col-print-6">
    <div class="portlet">
        <!-- /primary heading -->
        <div class="portlet-heading">
            <h3 class="portlet-title text-dark"> Ingresos/Mes/Día </h3>
            <div class="portlet-widgets">
                <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                <span class="divider"></span>
                <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default1"><i class="ion-minus-round"></i></a>

            </div>
            <div class="clearfix"></div>
        </div>
        <div id="bg-default1" class="panel-collapse collapse show">
            <div class="portlet-body">
                <div class="text-center">
                    <ul class="list-inline chart-detail-list">

                        <li class="list-inline-item">
                            <h5><i class="fa fa-circle m-r-5" style="color: #1ad1ff;"></i>Día</h5>
                        </li>
                    </ul>
                </div>
                <div id="ventasmes" style="height: 300px;"></div>
            </div>
        </div>
    </div>
    <!-- /Portlet -->
</div>
<div class="col-lg-6 col-print-6">
    <div class="portlet">
        <!-- /primary heading -->
        <div class="portlet-heading">
            <h3 class="portlet-title text-dark"> 10 Productos Más Vendidos/Mes </h3>
        </div>
        <div id="bg-default1" class="panel-collapse collapse show">
            <div class="portlet-body">
                <table class="table table-sm table-hover ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>barra</th>
                            <th>Nombre</th>
                            <th>Unidades Vendidas</th>
                        </tr>
                    </thead>
                    <tbody id="mvendidas">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /Portlet -->
</div>
<div class="col-lg-6 col-print-6">
    <div class="portlet">
        <!-- /primary heading -->
        <div class="portlet-heading">
            <h3 class="portlet-title text-dark"> Balance/Mes * Sucursales</h3>
            <div class="portlet-widgets">
                <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                <span class="divider"></span>
                <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default1"><i class="ion-minus-round"></i></a>

            </div>
            <div class="clearfix"></div>
        </div>
        <div id="bg-default1" class="panel-collapse collapse show">
            <div class="portlet-body">
                <div class="text-center">
                    <ul class="list-inline chart-detail-list">

                        <li class="list-inline-item">
                            <h5><i class="fa fa-circle m-r-5" style="color: #d1d1d1;"></i>Costos</h5>
                        </li>
                        <li class="list-inline-item">
                            <h5><i class="fa fa-circle m-r-5" style="color: #00cc00;"></i>Ganancias</h5>
                        </li>
                        <li class="list-inline-item">
                            <h5><i class="fa fa-circle m-r-5" style="color: #1ad1ff;"></i>Ingresos</h5>
                        </li>
                    </ul>
                </div>
                <div id="cyg" style="height: 300px;"></div>
            </div>
        </div>
    </div>
    <!-- /Portlet -->
</div>
<div class="col-lg-6 col-print-6">
    <div class="portlet">
        <!-- /primary heading -->
        <div class="portlet-heading">
            <h3 class="portlet-title text-dark"> Margen Ganancia/Mes</h3>
            <div class="portlet-widgets">
                <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                <span class="divider"></span>
                <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default1"><i class="ion-minus-round"></i></a>

            </div>
            <div class="clearfix"></div>
        </div>
        <div id="bg-default1" class="panel-collapse collapse show">
            <div class="portlet-body">
                <div class="text-center">
                    <ul class="list-inline chart-detail-list">

                        <li class="list-inline-item">
                            <h5><i class="fa fa-circle m-r-5" style="color: #d1d1d1;"></i>Costos</h5>
                        </li>
                        <li class="list-inline-item">
                            <h5><i class="fa fa-circle m-r-5" style="color: #00cc00;"></i>Ganancias</h5>
                        </li>
                    </ul>
                </div>
                <div id="porcentajes" style="height: 300px;"></div>
            </div>
        </div>
    </div>
    <!-- /Portlet -->
</div>
<!-- col -->




<div class="col-lg-12">
    <div class="portlet">
        <!-- /primary heading -->
        <div class="portlet-heading">
            <h3 class="portlet-title text-dark"> Ingresos Anuales </h3>
            <div class="portlet-widgets">
                <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                <span class="divider"></span>
                <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default1"><i class="ion-minus-round"></i></a>

            </div>
            <div class="clearfix"></div>
        </div>
        <div id="bg-default1" class="panel-collapse collapse show">
            <div class="portlet-body">
                <div class="text-center">
                    <ul class="list-inline chart-detail-list">
                        <li class="list-inline-item">
                            <h5><i class="fa fa-circle m-r-5" style="color: #33d6ff;"></i>Ingresos</h5>
                        </li>

                    </ul>
                </div>
                <div id="anuales" style="height: 300px;"></div>
            </div>
        </div>
    </div>
    <!-- /Portlet -->
</div>
@endsection
 
@section("scripts")
<script>
    $.ajax({
        
        url: "admin/dashboard/json/inicio",
        method: 'get',
        beforeSend: function () {

        },
        success: function (response) {
            
            barchar('anuales', response['mesesrentables'], 'nmes', ['total'], ['Ingresos/Mes Q'], ['#1ad1ff']);
            barchar('cyg', response['sucursalrentable'], 'nombre', ['costos','ganancias','total'], ['Costos Q','Ganancias Q','Total Q'], ['#d1d1d1','#00cc00','#1ad1ff']);
            barchar('ventasmes', response['ventasmes'], 'fecha', ['total'], ['Total del Día Q'], ['#1ad1ff']);
            $("#nsucursal").text(response['balancemes']['sucursales']);
            
            $("#ncostos").text(response['balancemes']['costos']);
            $("#nganancias").text(response['balancemes']['ganancias']);
            $("#ningresos").text(response['balancemes']['total']);
            
            var costos=response['balancemes']['costos'];
            var ganancias=response['balancemes']['ganancias'];
            var total=response['balancemes']['total'];
            var pc=(costos/total)*100;
            
            var gc=100-pc;
            var $donutData = [
                {label: "Costo/Mes", value: pc.toFixed(0)},
                {label: "Ganancia/Mes", value: gc.toFixed(0)},
                
            ];
            donutchar('porcentajes', $donutData, ['#d1d1d1', '#52bb56']);




            var td="";
            var mv=response['masvendidos'].sort(function (a, b) { return b['uvendidas']-a['uvendidas'] ; });
            var i=0;
            $.each( mv, function( i, item ) {
                var l=i+1;
                td+="<tr><td>"+l+"</td>"+"<td>"+item['barra']+"</td>"+"<td>"+item['nombre']+"</td>"+"<td>"+item['uvendidas']+"</td></tr>";
                if(l == 10) {
                    return false;
                }
            });
            
            $("#mvendidas").html(td);
        }
    });

</script>
@endsection