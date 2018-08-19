@extends('admin.layout') 
@section('title', "Inicio") 
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
                        <div class="form-group col-md-4">
                            <label for="idsucursal">Sucursal</label>
                            <select id="sucursal" name="idsucursal" class="form-control" id="">
                                <option value="0">Seleccione la sucursal</option>
                                @forelse($sucursales as $sl)
                                <option value="{{$sl->idsucursal}}">{{$sl->nombre}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group col-md-8">
                            <label class=" control-label">Fecha</label>
                            <div class="">
                                <div id="reportrange" class="pull-right form-control">
                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                    <span></span>
                                </div>
                                <input type="hidden" name="" id="fecha">
                            </div>
                        </div>
                        <div class="col-md-4 align-bottom">

                            <button class="btn btn-success hidden-print" id="mostrar"><i class=" ti-bar-chart"></i> Mostrar Datos</button>
                            <a href="javascript:window.print()" class="btn btn-dark waves-effect waves-light"><i class="fa fa-print"></i> Imprimir</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12 hide" id="divload">
    <div class="col-md-12 text-center">

        <img src="{{asset('images/app/load7.gif')}}" width="80" alt="">
        <p class="text-muted">Cargando...</p>
    </div>
</div>
<div class="col-lg-3 hide col-md-3">
    <div class="widget-bg-color-icon card-box">
        <div class="bg-icon bg-icon-primary pull-left">
            <i class=" ti-bag text-success"></i>
        </div>
        <div class="text-right">
            <h3 class="text-dark m-t-10"><b class="counter" id="nsucursal"></b></h3>
            <p class="text-muted mb-0">Ventas</p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="col-lg-3 hide col-md-3">
    <div class="widget-bg-color-icon card-box">
        <div class="bg-icon bg-icon-danger pull-left">
            <i class="ti-money text-success"></i>
        </div>
        <div class="text-right">
            <h3 class="text-dark m-t-10">Q <b class="counter" id="ncostos"></b></h3>
            <p class="text-muted mb-0">Costos</p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="col-lg-3 hide col-md-3">
    <div class="widget-bg-color-icon card-box">
        <div class="bg-icon bg-icon-success pull-left">
            <i class=" ti-stats-up text-success"></i>
        </div>
        <div class="text-right">
            <h3 class="text-dark m-t-10">Q <b class="counter" id="nganancias"></b></h3>
            <p class="text-muted mb-0">Ganancias</p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="col-lg-3 hide col-md-3">
    <div class="widget-bg-color-icon card-box">
        <div class="bg-icon bg-icon-info pull-left">
            <i class=" ti-bag text-success"></i>
        </div>
        <div class="text-right">
            <h3 class="text-dark m-t-10">Q <b class="counter" id="ningresos"></b></h3>
            <p class="text-muted mb-0">Ingresos</p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="col-md-6 hide col-print-6">
    <div class="portlet">
        <!-- /primary heading -->
        <div class="portlet-heading">
            <h3 class="portlet-title text-dark"> Balance</h3>
            <div class="portlet-widgets">
                <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                <span class="divider"></span>
                <a data-toggle="collapse" data-parent="#accordion1" href="#prtbalance"><i class="ion-minus-round"></i></a>

            </div>
            <div class="clearfix"></div>
        </div>
        <div id="prtbalance" class="panel-collapse collapse show">
            <div class="portlet-body">
                <div class="text-center">
                    <ul class="list-inline chart-detail-list">

                        <li class="list-inline-item">
                            <h5><i class="fa fa-circle m-r-5" style="color: #f2f2f2;"></i>Costos</h5>
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
<div class="col-md-6 hide col-print-6">
    <div class="portlet">
        <!-- /primary heading -->
        <div class="portlet-heading">
            <h3 class="portlet-title text-dark"> Ingresos/Día </h3>
            <div class="portlet-widgets">
                <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                <span class="divider"></span>
                <a data-toggle="collapse" data-parent="#accordion1" href="#prtingresos"><i class="ion-minus-round"></i></a>

            </div>
            <div class="clearfix"></div>
        </div>
        <div id="prtingresos" class="panel-collapse collapse show">
            <div class="portlet-body">
                <div class="text-center">
                    <ul class="list-inline chart-detail-list">

                        <li class="list-inline-item">
                            <h5><i class="fa fa-circle m-r-5" style="color: #f2f2f2;"></i>Costos</h5>
                        </li>
                        <li class="list-inline-item">
                            <h5><i class="fa fa-circle m-r-5" style="color: #00cc00;"></i>Ganancias</h5>
                        </li>
                    </ul>
                </div>
                <div id="ventasmes" style="height: 300px;"></div>
            </div>
        </div>
    </div>
    <!-- /Portlet -->
</div>
<div class="col-md-6 hide col-print-6">
    <div class="portlet">
        <!-- /primary heading -->
        <div class="portlet-heading">
            <h3 class="portlet-title text-dark">Margen Ganancia %</h3>
            <div class="portlet-widgets">
                <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                <span class="divider"></span>
                <a data-toggle="collapse" data-parent="#accordion1" href="#prtganancia"><i class="ion-minus-round"></i></a>

            </div>
            <div class="clearfix"></div>
        </div>
        <div id="prtganancia" class="panel-collapse collapse show">
            <div class="portlet-body">
                <div class="text-center">
                    <ul class="list-inline chart-detail-list">

                        <li class="list-inline-item">
                            <h5><i class="fa fa-circle m-r-5" style="color: #f2f2f2;"></i>Costos</h5>
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
<div class="col-md-6 hide col-print-6">
    <div class="portlet">
        <!-- /primary heading -->
        <div class="portlet-heading">
            <h3 class="portlet-title text-dark"> 10 Productos Más Vendidos</h3>
            <div class="portlet-widgets">
                <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                <span class="divider"></span>
                <a data-toggle="collapse" data-parent="#accordion1" href="#prttop10"><i class="ion-minus-round"></i></a>

            </div>
            <div class="clearfix"></div>
        </div>
        <div id="prttop10" class="panel-collapse collapse show">
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
<div class="col-md-12 hide">
    <div class="portlet">
        <!-- /primary heading -->
        <div class="portlet-heading">
            <h3 class="portlet-title text-dark"> Ingresos Anuales </h3>
            <div class="portlet-widgets">
                <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                <span class="divider"></span>
                <a data-toggle="collapse" data-parent="#accordion1" href="#prtanuales"><i class="ion-minus-round"></i></a>

            </div>
            <div class="clearfix"></div>
        </div>
        <div id="prtanuales" class="panel-collapse collapse show">
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
</div>
<div class="col-md-12 hide">
    <div class="portlet">
        <!-- /primary heading -->
        <div class="portlet-heading">
            <h3 class="portlet-title text-dark"> Ventas Realizadas </h3>
            <div class="portlet-widgets">
                <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                <span class="divider"></span>
                <a data-toggle="collapse" data-parent="#accordion1" href="#prtventas"><i class="ion-minus-round"></i></a>

            </div>
            <div class="clearfix"></div>
        </div>
        <div id="prtventas" class="panel-collapse collapse show">
            <div class="portlet-body">
                <table class="table table-hover table-stripled">
                    <thead>
                        <tr>
                            <th>Id Venta</th>
                            <th>Fecha</th>
                            <th>Subtotal</th>
                            <th>Descuento</th>
                            <th>Total</th>
                            <th>Costo</th>
                            <th>Ganancia</th>
                            <th>Margen</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody id="infoventas">
                        <tr>
                            <td colspan="9" class="text-center">No hay Registros</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="CenterModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="portlet-title text-dark"> Detalles </h3>
            </div>
            <div class="modal-body">
                <table class="table table-hover table-sm table-stripled">
                    <thead>
                        <tr>
                            <th>Cantidad</th>
                            <th>Barra</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                            <th>Descuento (Presentacion)</th>
                            <th>Total</th>
                            <th>Costos</th>
                            <th>Ganancia</th>
                        </tr>
                    </thead>
                    <tbody id="infodetalles">
                        <tr>
                            <td colspan="9" class="text-center">No hay Registros</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

@endsection
 
@section("scripts")
<script src="{{asset('tema2/plugins/moment/moment.js')}}"></script>
<script src="{{asset('tema2/plugins/moment/src/locale/es.js')}}"></script>
<script src="{{asset('tema2/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('tema2/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('tema2/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script>
    reportrange();
    function detalles(idventa){
        $.ajax({
        url: "inicio/detalles/"+idventa,
        method: 'get',
        
        beforeSend: function () {
            
        },
        success: function (response) {
           if(response[0]['resultado']==1){
               var td="";
                resultados=response[0]['datos'];
                var i=0;
                $.each( resultados, function( i, item ) {
                    var l=i+1;
                    td+="<tr><td>"+item['cantidad']+"</td>"+"<td>"+item['barra']+"</td>"+"<td>"+item['nombre']+"</td>"+"<td>"+item['precioxpre']+"</td>"+"<td>"+item['subtotal']+"</td>"+"<td>"+item['descuento']+"</td>"+"<td>"+item['total']+"</td>"+"<td>"+item['costo']+"</td>"+"<td>"+item['ganancia']+"</td>"+"</tr>";
                });
           }
           $("#infodetalles").html(td);
           $("#CenterModal").modal('show');
        }
    });
    }
    $("#mostrar").click(function(){
        loadreporte();
    });
    $('body').on('click','.btn-infoventas', function(){
        detalles($(this).data('idventa'));
    });
</script>
@endsection