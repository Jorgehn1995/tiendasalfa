@extends('admin.layout') 
@section('title', "Editar Usuario") 
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
                <h6>Editar Usuario {{$item->nombre." ".$item->apellido}}</h6>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('usuarios.update',$item->idusuario)}}">
                    @csrf {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre" class="control-label">Nombre <span class="text-danger">*</span></label>
                                <input type="text" required class="form-control" name="nombre" value="{{$item->nombre}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apellido" class="control-label">Apellido <span class="text-danger">*</span></label>
                                <input type="text" required class="form-control" name="apellido" value="{{$item->apellido}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="direccion" class="control-label">Direccion</label>
                                <input type="text" name="direccion" class="form-control" value="{{$item->direccion}}" id="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono" class="control-label">Telefono</label>
                                <input type="text" name="telefono" class="form-control" value="{{$item->telefono}}" id="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="idtipo" class="control-label">Tipo <span class="text-danger">*</span></label>
                                <select name="idtipo" required class="form-control" id="">
                                        @foreach($tipos as $tipo)
                                            @if($item->idtipo==$tipo->idtipo)
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
                                <input type="text" required autocomplete="false" name="usuario" class="form-control" value="{{$item->usuario}}" id="">
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="estado" class="control-label">Estado <span class="text-danger">*</span></label>
                                    <select name="estado" class="form-control" id="">
                                        @if($item->estado==1)
                                            <option selected value="1">Activo</option>
                                            <option value="2">Inactivo</option>
                                        @else
                                            <option  value="1">Activo</option>
                                            <option selected value="2">Inactivo</option>
                                        @endif
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