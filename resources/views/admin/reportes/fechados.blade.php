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
                                <strong>{{date("Y-m-d h.i.s")}}</strong>
                            </h6>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="col-md-6 pull-left m-t-30">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="idsucursal">Sucursal</label>
                                        <select id="sucursal" name="idsucursal" class="form-control" id="">
                                            <option value="0">Seleccione la sucursal</option>
                                            @forelse($sucursales as $sl)
                                            @if($sl->idsucursal==$fechas[0]["idsucursal"])
                                            <option selected value="{{$sl->idsucursal}}">{{$sl->nombre}}</option>
                                            @else 
                                            <option value="{{$sl->idsucursal}}">{{$sl->nombre}}</option>
                                            @endif
                                            
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="idsucursal">Fecha Inicial</label>
                                        <input type="date" class="form-control" id="inicio" value="{{$fechas[0]['inicio']}}">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="idsucursal">Fecha Final</label>
                                        <input type="date" class="form-control" id="fin" value="{{$fechas[0]['fin']}}">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <button class="btn btn-success" id="mostrar">Mostrar</button>
                                        <a href="javascript:window.print()" class="btn btn-dark waves-effect waves-light"><i class="fa fa-print"></i></a>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-4 pull-right m-t-30">
                                <p class="text-right"><b>Sub-total:</b>Q {{array_sum(array_column($ventas->all(), 'subtotal'))}}</p>
                                <p class="text-right">Descuentos: Q {{array_sum(array_column($ventas->all(), 'descuento'))}}</p>
                                <hr>
                                <h4 class="text-right">Total: Q {{array_sum(array_column($ventas->all(), 'total')),2}}</h4> <br>
                                <p class="text-right">Costos: Q {{array_sum(array_column($ventas->all(), 'costos'))}}</p>
                                <p class="text-right">Ganancias: Q {{array_sum(array_column($ventas->all(), 'ganancias'))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="m-h-50"></div>
                    <div class="row">
                        <div id="grafica" class="" style="height: 200px;"></div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">

                                @forelse($ventas as $venta)
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
                                        @foreach($venta->detalles as $detalle)
                                        <tr>
                                            <td>{{$detalle->producto->barra}}</td>
                                            <td> {{$detalle->producto->nombre}}</td>
                                            <td> {{$detalle->total}}</td>

                                        </tr>

                                        @endforeach
                                        <tr class="table-secondary">

                                            <td colspan="2" class="text-center">{{date("d/m/Y",strtotime($venta->fecha))}}</td>
                                            <td>Sub-Total Q {{$venta->subtotal}}</td>
                                            <td>Desc. Q {{$venta->descuento}}</td>
                                            <td>Total Q {{$venta->total}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr> @empty
                                <div class="col-md-12 text-center">
                                    <p>No hay registros</p>
                                </div>
                                @endforelse

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
    var sucursal=$("#sucursal").val();
        var inicio=$("#inicio").val();
        var fin=$("#fin").val();
    $("#mostrar").click(function(){
        var sucursal=$("#sucursal").val();
        var inicio=$("#inicio").val();
        var fin=$("#fin").val();
        location.href="../../"+sucursal+"/"+inicio+"/"+fin;
    });
    $.ajax({
        
        url: "../../../json/fechados/"+sucursal+"/"+inicio+"/"+fin,
        method: 'get',
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);
            
            barchar('grafica', response, 'fecha', ['total'], ['Vendido'], ['#52bb56']);
            //barchar('unidades', response, 'nombre', ['articulos'], ['Articulos en Sucursal'], ['#ff9933']);
        }
    });

</script>
@endsection