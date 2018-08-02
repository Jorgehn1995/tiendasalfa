@extends('admin.layout') 
@section('title', "Agregar Sucursal") 
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
    <div class="card-box">
        <div class="row">
            <div class="col-md-12">
                <h6>@yield('title')</h6>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('sucursales.store')}}">
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nombre" class="control-label">Nombre <span class="text-danger">*</span></label>
                                <input type="text" required class="form-control" name="nombre" value="{{old('nombre')}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="direccion" class="control-label">Direccion</label>
                                <input type="text" name="direccion" class="form-control" value="{{old('direccion')}}" id="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono" class="control-label">Telefono</label>
                                <input type="text" name="telefono" class="form-control" value="{{old('telefono')}}" id="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="idusuario" class="control-label">Encargado <span class="text-danger">*</span></label>
                                <select name="idusuario" required class="form-control" id="">
                                    @foreach($usuarios as $usuario)
                                        @if(old('idusuario')==$usuario->idusuario)
                                            <option selected value="{{$usuario->idusuario}}">{{$usuario->nombre." ".$usuario->apellido}}</option>
                                        @else
                                            <option value="{{$usuario->idusuario}}">{{$usuario->nombre." ".$usuario->apellido}}</option>
                                        @endif 
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <p class="text-muted"> (<span class="text-danger">*</span>) Datos Obligatorios</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" onclick="location.href='{{route('sucursales.index')}}'" class="btn btn-secondary"><i class="ti-arrow-left"></i> Regresar</button>
                            <button type="submit" class="btn btn-success"><i class="ti-save"></i> Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection