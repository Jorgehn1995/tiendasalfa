@extends('admin.layout') 
@section('title', "Agregar Producto") 
@section('content')

<div class="col-md-12 m-b-15">


</div>
<div class="col-md-12">
    @if(count($errors)>0)
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> @foreach($errors->all() as
        $error)
        <li> {{$error}}</li>
        @endforeach
    </div>
    @endif
    <div class="row " id="divload">
        <div class="col-md-12 text-center">

            <img src="{{asset('images/app/load7.gif')}}" width="80" alt="">
            <p class="text-muted">Cargando...</p>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-7 panel hide">
            <div class="col-md-12">
                <div class="card-box">
                    <div class="input-group">
                        <input type="text" id="scod" class="form-control" placeholder="Codigo del Producto" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary waves-effect waves-light" id="sbcod" type="button"><i class="ti-search"></i> Buscar</button>
                            <button class="btn btn-secondary waves-effect waves-light" data-toggle="modal" data-target=".modalProductos" type="button"><i class="ti-search"></i> Por Nombre</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-12">
                            <h6 class="portlet-title text-dark hide-phone" id="frmTitle">@yield('title')</h6>
                            <hr>
                        </div>
                    </div>
                    <form method="POST" action="{{route('productos.store')}}">
                        @csrf
                        <input type="hidden" name="" id="metodo" value="create">
                        <input type="hidden" name="" id="idproducto">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="codigo" class="control-label">Codigo <span class="text-danger">*</span></label>
                                    <input id="codigo" type="text" required class="form-control required" name="codigo">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="nombre" class="control-label">Nombre <span class="text-danger">*</span></label>
                                    <input id="nombre" type="text" required class="form-control required" name="nombre">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="costo" class="control-label">Precio Costo <span class="text-danger">*</span></label>
                                    <input id="costo" type="number" step=".10" name="costo" class="form-control required">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="venta" class="control-label">Precio Venta <span class="text-danger">*</span></label>
                                    <input id="venta" type="number" step=".10" name="venta" class="form-control required">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ganancia" class="control-label">Ganancia</label>
                                    <input id="ganancia" type="number" step=".10" name="ganancia" readonly class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="caducidad" class="control-label">Caducidad </label>
                                    <input id="caducidad" type="date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 hide">
                                <div class="form-group ">
                                    <label class="control-label">Categoria</label>
                                    <div class="input-group">
                                        <select name="" class="form-control" id="categorias">
                                                        <option value="">Sin Categoria</option>
                                                    </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-success waves-effect waves-light" type="button"><i class="ti-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p class="text-muted"> (<span class="text-danger">*</span>) Datos Obligatorios</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-secondary"><i class="ti-arrow-left"></i> Regresar</button>
                                <button type="button" id="agsave" class="btn btn-success"><i class="ti-save"></i> Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5 panel hide">
            <div class="col-md-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-12">
                            <h6 class="portlet-title text-dark hide-phone">Existencias</h6>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table  table-hover">
                            <thead>
                                <tr>
                                    <th>Sucursal</th>
                                    <th>Actual</th>
                                    <th width="25%">+Nueva</th>
                                </tr>
                            </thead>
                            <tbody id="existencias">
                                <tr>
                                    <td colspan="3" class="text-center">Primero registre el producto</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="pull-left">
                                <h6 class="portlet-title text-dark hide-phone">Presentaciones</h6>
                            </div>

                        </div>
                        <div class="col-md-6 m-b-10">
                            <div class="pull-right">
                                <button type="button"  disabled data-toggle="modal" data-target=".modalpresentacion" class="btn btn-success btn-sm btnPresentaciones"><i class="ti-plus"></i> </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table  table-hover">
                            <thead>
                                <tr>
                                    <th>Presentacion</th>
                                    <th>Unidades</th>
                                    <th>Precio</th>
                                    <td><i class=" ti-eraser"></i></td>
                                </tr>
                            </thead>
                            <tbody id="presentaciones">
                                <tr>
                                    <td colspan="3" class="text-center">Primero registre el producto</td>
                                </tr>
                            </tbody>
                        </table>
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
                <h6>Productos</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-xs" width="100%" id="modalproductos">
                            <thead>
                                <tr>
                                    <td>Barra</td>
                                    <td style="white-space:nowrap;">Producto</td>
                                    <td>Precio U.</td>
                                    <td>Agregar</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($productos as $producto)
                                <tr>
                                    <td>{{$producto->barra}}</td>
                                    <td>{{$producto->nombre}}</td>
                                    <td>{{$producto->venta}}</td>
                                    <td>
                                        <div class="col-md-12">
                                            <button class="btn btn-primary btn-sm pronombre" data-barra="{{$producto->barra}}">Revisar</button>
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
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade modalpresentacion" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h6>Presentaciones</h6>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="prenombre" class="control-label">Nombre de Presentación </label>
                            <input id="prenombre" type="text" class="form-control prerequired">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="preunidades" class="control-label">Cantidad de Unidades </label>
                            <input id="preunidades" type="number" class="form-control prerequired">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="preprecio" class="control-label">Precio de la Presentación </label>
                            <input id="preprecio" step="0.25" type="number" class="form-control prerequired">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 pull-right">
                            <button class="btn btn-success btnPresentaciones" id="btn-presentacion"><i class="ti-save"></i> Guardar Presentación</button>
                    </div>
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
    modalproductos();
    $(document).ready(function(){
        $("#divload").hide(500);
        $(".panel").show(500);
    });

</script>
@endsection