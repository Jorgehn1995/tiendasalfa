@extends('admin.layout') 
@section('title', "Venta | ".$sucursal->nombre ) 
@section('content')
<div class="col-md-12 m-t-15">
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="m-t-0 m-b-30 header-title">Sucursal {{$sucursal->nombre}}</h4>
                        <div class="form-group row">
                            <div class="col-12 col-md-12">
                                <div class="input-group">
                                    <input type="text" id="" class="form-control" placeholder="Codigo del Producto" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-success waves-effect waves-light" id="addcart" type="button"><i class=" ti-shopping-cart"></i> Agregar</button>
                                        <button class="btn btn-secondary waves-effect waves-light" type="button"><i class="ti-search"></i> Por Nombre</button>
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Barra</td>
                                    <td>Producto</td>
                                    <td>Precio U.</td>
                                    <td>Cantidad</td>
                                    <td>Total</td>
                                </tr>
                            </thead>
                            <tbody id="temp">
                                <tr>
                                    <td>12345</td>
                                    <td>Doritos</td>
                                    <td>4 </td>
                                    <td>2</td>
                                    <td>8</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box bg-dark text-white text-center">
                        <p class=""><b>Cliente:</b> <span>C/F</span></p>
                        <div class="col-md-12">

                            <p class="text-right"><b>Sub-total:</b> Q <span id="subtotal">00.00</span></p>
                            <p class="text-right">Descuento: <span id="descuento">00.00</span></p>
                            <hr>
                            <h4 class="text-right  text-success">Q <span id="total">00.00</span></h4>
                            <p class="text-right">Efectivo: <span id="efectivo">00.00</span> | Cambio : <span id="cambio">00.00</span></p>
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
                                    <label for="efectivo">Efectivo</label>
                                    <input type="number" class="form-control">
                                    <input type="hidden" id="idsucursal" value="{{$sucursal->idsucursal}}" name="">
                                    <input type="hidden" id="idusuario" value="{{Auth::User()->idusuario}}" name="">
                                    <input type="hidden" id="idcliente" name="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 btn-group">
                                <button class="btn btn-success">Procesar</button>
                                <button class="btn btn-secondary">Desc.</button>
                                <button class="btn btn-primary">Cliente.</button>
                                <button class="btn btn-danger">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection