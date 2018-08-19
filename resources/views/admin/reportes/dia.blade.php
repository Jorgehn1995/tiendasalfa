@extends('admin.layout') 
@section('title', "Reporte Ventas del Día") 
@section('content')
<div class="col-md-12 m-t-15">
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <!-- <div class="panel-heading">
                            <h4>Invoice</h4>
                        </div> -->
                <div class="panel-body">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h3 class="text-right"><i class="ti-shopping-cart"></i>AlfaPOS</h3>
                        </div>
                        <div class="pull-right">
                            <h6>Reporte # <br>
                                <strong>{{date("Y-m-d h.i.s").$sucursal->idsucursal}}</strong>
                            </h6>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="pull-left m-t-30">
                                <address>
                                            <strong>{{$sucursal->nombre}}</strong><br>
                                            {{$sucursal->direccion}}<br>
                                            
                                            <abbr title="Phone"><i class="ti-phone"></i></abbr> {{$sucursal->telefono}}
                                        </address>
                                <p><strong>Fecha de Orden: </strong> {{date("d/m/Y")}}</p>
                                <p class="m-t-10"><strong>Tipo de Orden: </strong> Reporte Día</p>
                            </div>
                            <div class="pull-right m-t-30">
                                <p class="text-right"><b>Sub-total:</b>Q {{array_sum(array_column($ventas->all(), 'subtotal'))}}</p>
                                <p class="text-right">Descuento: Q {{array_sum(array_column($ventas->all(), 'descuento'))}}</p>
                                <hr>
                                <h4 class="text-right">Q {{round(array_sum(array_column($ventas->all(), 'total')),2)}}</h4>

                            </div>
                        </div>
                    </div>
                    <div class="m-h-50"></div>
                    <div class="row">
                        <div class="col-12">
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
                    <div class="row">
                        <div class="col-6">
                            <div class="clearfix m-t-40">

                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="d-print-none">
                        <div class="text-right">
                            <a href="javascript:window.print()" class="btn btn-dark waves-effect waves-light"><i class="fa fa-print"></i></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
 
@section("scripts")
<script>

</script>
@endsection