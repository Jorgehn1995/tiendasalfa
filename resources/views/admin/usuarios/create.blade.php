@extends('admin.layout') 
@section('title', "Agregar Usuario") 
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
                <h4>@yield('title')</h4>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('usuarios.store')}}">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre" class="control-label">Nombre <span class="text-danger">*</span></label>
                                <input type="text" required class="form-control" name="nombre" value="{{old('nombre')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apellido" class="control-label">Apellido <span class="text-danger">*</span></label>
                                <input type="text" required class="form-control" name="apellido" value="{{old('apellido')}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="direccion" class="control-label">Direccion</label>
                                <input type="text"  name="direccion" class="form-control" value="{{old('direccion')}}" id="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono" class="control-label">Telefono</label>
                                <input type="text"  name="telefono" class="form-control" value="{{old('telefono')}}" id="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="idtipo" class="control-label">Tipo <span class="text-danger">*</span></label>
                                <select name="idtipo" required class="form-control" id="">
                                    @foreach($tipos as $tipo)
                                        @if(old('tipo')==$tipo->idtipo)
                                            <option selected value="{{$tipo->idtipo}}">{{$tipo->nombre}}</option>
                                        @else
                                            <option value="{{$tipo->idtipo}}">{{$tipo->nombre}}</option>
                                        @endif 
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usuario" class="control-label">Usuario <span class="text-danger">*</span></label>
                                <input type="text" required  autocomplete="false" name="usuario" class="form-control" value="{{old('usuario')}}" id="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password" class="control-label">Contraseña <span class="text-danger">*</span></label>
                                <input type="password" autocomplete="false"  required name="password" class="form-control" value="{{old('pasword')}}" id="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <p class="text-muted"> (<span class="text-danger">*</span>) Datos Obligatorios</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" onclick="location.href='{{route('usuarios.index')}}'" class="btn btn-secondary"><i class="ti-arrow-left"></i> Regresar</button>
                            <button type="submit" class="btn btn-success"><i class="ti-save"></i> Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection