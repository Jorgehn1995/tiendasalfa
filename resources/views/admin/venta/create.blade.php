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
    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <div class="form-group row">
                    <label class="col-12 col-md-3 col-form-label">Codigo del producto</label>
                    <div class="col-12 col-md-9">
                        <div class="input-group">
                            <input type="text" id="scod" class="form-control" placeholder="Codigo del Producto" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary waves-effect waves-light" id="sbcod" type="button"><i class="ti-search"></i> Buscar</button>
                                <button class="btn btn-secondary waves-effect waves-light" type="button"><i class="ti-search"></i> Por Nombre</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-12">
                        <h6 id="frmTitle">@yield('title')</h6>
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
                        <div class="col-md-6">
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
        <div class="col-md-5">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-12">
                        <h6>Existencias</h6>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Sucursal</th>
                                <th>Actual</th>
                                <th width="25%">+Nueva</th>
                            </tr>
                        </thead>
                        <tbody id="existencias">
                            <tr>
                                <td colspan="3"class="text-center">Primero registre el producto</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection