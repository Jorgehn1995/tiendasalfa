@extends('admin.venta.layout') 
@section('title', "Venta | ".$sucursal->nombre ) 
@section('content')
<div class="col-md-12 m-t-15">
    <div class="row " id="divload">
        <div class="col-md-12 text-center">
            <img src="{{asset('images/app/load7.gif')}}" width="80" alt="">
        </div>
    </div>
    <div class="row ">
        <div class="col-md-8 hide panel">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="m-t-0 m-b-30 header-title">Sucursal {{$sucursal->nombre}}</h4>
                        <div class="form-group row">
                            <div class="col-12 col-md-12">
                                <div class="input-group">
                                    <input type="text" id="sbarra" class="form-control sventainput" placeholder="Codigo del Producto" aria-label="Recipient's username"
                                        aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <div class="col-md-4"><input type="number" id="scantidad" class="form-control sventainput" placeholder="Cantidad"></div>
                                        <button class="btn btn-success waves-effect waves-light" id="addcart" type="button"><i class=" ti-shopping-cart"></i> Agregar</button>
                                        <button class="btn btn-secondary waves-effect waves-light" data-toggle="modal" data-target=".modalProductos" type="button"><i class="ti-search"></i> Por Nombre</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <td>Barra</td>
                                    <td>Producto</td>
                                    <td>Precio U.</td>
                                    <td>Cantidad</td>
                                    <td>Total</td>
                                    <td>Opciones</td>
                                </tr>
                            </thead>
                            <tbody id="temp">
                                <tr>
                                    <td class="text-center " colspan="6">No hay productos agregados</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 hide panel">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box bg-dark text-white text-center">
                        <p class=""><b>Cliente:</b> <span>C/F</span></p>
                        <div class="col-md-12">

                            <p class="text-right"><b>Sub-total:</b> Q <span id="subtotal">00.00</span></p>
                            <p class="text-right hide">Descuento: <span id="descuento">00.00</span></p>
                            <hr>
                            <h3 class="text-right  text-success">Q <span id="total">00.00</span></h3>
                            <p class="text-right">Cambio: Q <span id="cambio">00.00</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputdescuento">Descuento</label>
                                    <input type="number" id="inputdescuento" step=".25" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="efectivo">Efectivo</label>
                                    <input type="number" id="inputefectivo" class="form-control"> @csrf
                                    <input type="hidden" id="idsucursal" value="{{$sucursal->idsucursal}}" name="">
                                    <input type="hidden" id="articulos">
                                    <input type="hidden" id="costos">
                                    <input type="hidden" id="ganancias">
                                    <input type="hidden" id="idusuario" value="{{Auth::User()->idusuario}}" name="">
                                    <input type="hidden" id="idcliente" name="">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12 btn-group">
                                <button class="btn btn-success" id="procesar"><i class=" ti-angle-right"></i> Procesar</button>
                                <button class="btn btn-primary" data-toggle="modal" data-target=".modalclientes"> <i class=" ti-id-badge"></i> Cliente</button>
                                <button class="btn btn-danger"><i class="ti-close"></i> Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modalProductos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Productos</h4>
            </div>
            <div class="modal-body">
                <table class="table table-xs" id="modalproductos">
                    <thead>
                        <tr>
                            <td>Barra</td>
                            <td>Producto</td>
                            <td>Precio U.</td>
                            <td width="15%">Cantidad</td>
                            <td>Agregar</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productos as $producto)
                        <tr>
                            <td>{{$producto->barra}}</td>
                            <td>{{$producto->nombre}}</td>
                            <td>{{$producto->venta}}</td>
                            <td width="15%"><input type="number" class="form-control cantpro"></td>
                            <td>
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-sm addnombre" data-barra="{{$producto->barra}}">Agregar</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">No existen productos</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade modalclientes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Clientes</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                </div>
                <div class="row">
                    <p class="text-muted">En despliegue</p>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection
 
@section("scripts")
<script>
    limpiartemp();
    modalproductos();

</script>
@endsection