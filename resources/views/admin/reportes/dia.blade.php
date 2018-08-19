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
                        <div class="form-group col-md-4">
                            <label for="idsucursal">Sucursal</label>
                            <input type="text" class="form-control" disabled value="{{$sucursal->nombre}}">
                        </div>
                        <div class="form-group col-md-8">
                            <label class=" control-label disabled">Fecha</label>
                            <div class="">
                                <div id="reportrange" class="pull-right form-control">
                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                    <span></span>
                                </div>
                                <input type="hidden" name="" id="fecha">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-3  col-md-3">
    <div class="widget-bg-color-icon card-box">
        <div class="bg-icon bg-icon-primary pull-left">
            <i class=" ti-bag text-success"></i>
        </div>
        <div class="text-right">
            <h3 class="text-dark m-t-10"><b class="counter" id="nsucursal">{{$bags}}</b></h3>
            <p class="text-muted mb-0">Ventas</p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="col-lg-3  col-md-3">
    <div class="widget-bg-color-icon card-box">
        <div class="bg-icon bg-icon-danger pull-left">
            <i class="ti-package text-success"></i>
        </div>
        <div class="text-right">
            <h3 class="text-dark m-t-10">Q <b class="counter" id="ncostos">{{array_sum(array_column($ventas->all(), 'subtotal'))}}</b></h3>
            <p class="text-muted mb-0">Subtotal</p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="col-lg-3  col-md-3">
    <div class="widget-bg-color-icon card-box">
        <div class="bg-icon bg-icon-success pull-left">
            <i class=" ti-stats-up text-success"></i>
        </div>
        <div class="text-right">
            <h3 class="text-dark m-t-10">Q <b class="counter" id="nganancias">{{array_sum(array_column($ventas->all(), 'descuento'))}}</b></h3>
            <p class="text-muted mb-0">Descuentos</p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="col-lg-3  col-md-3">
    <div class="widget-bg-color-icon card-box">
        <div class="bg-icon bg-icon-info pull-left">
            <i class="  ti-money text-success"></i>
        </div>
        <div class="text-right">
            <h3 class="text-dark m-t-10">Q <b class="counter" id="ningresos">{{round(array_sum(array_column($ventas->all(), 'total')),2)}}</b></h3>
            <p class="text-muted mb-0">Total</p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="col-12">
    <div class="card-box">
        <div class="table-responsive">
            <table id="productos" class="table   " data-tablesaw-mode="stack">
                <thead>
                    <tr>
                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Codigo</th>
                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3">Producto</th>
                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Subtotal</th>
                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1">Descuento</th>
                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">Total</th>


                    </tr>
                </thead>
                <tbody>
                    @forelse($ventas as $venta) @foreach($venta->detalles as $detalle)
                    <tr>
                        <td>{{$detalle->producto->barra}}</td>
                        <td> {{$detalle->producto->nombre}}</td>
                        <td> {{$detalle->total}}</td>

                    </tr>

                    @endforeach
                    <tr class="table-success">
                        <td>ID Venta {{$venta->idventa}}</td>
                        <td>Fecha {{date("d/m/Y",strtotime($venta->fecha))}}</td>
                        <td>Sub-Total Q {{$venta->subtotal}}</td>
                        <td>Desc. Q {{$venta->descuento}}</td>
                        <td>Total Q {{$venta->total}}</td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No hay registros</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
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