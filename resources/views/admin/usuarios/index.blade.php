@extends('admin.layout') 
@section('title', "Usuarios") 
@section('content')
<div class="col-md-12 m-t-15">
    <div class="portlet">
        <div class="portlet-heading portlet-default">
            <h3 class="portlet-title text-dark hide-phone">
                @yield('title')
            </h3>
            <div class="portlet-widgets">
                <a data-toggle="collapse" class="btn btn-secondary" data-parent="#accordion{{Auth::User()->idtienda}}" href="#tab{{Auth::User()->idtienda}}"><i class="ion-minus-round text-light"></i></a>
                <span class="divider"></span>
                <button type="button" onclick="location.href='{{ route('usuarios.create')}}'" class="btn btn-success"><i class="ti-plus"></i> Agregar @yield('title') </button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div id="tab{{Auth::User()->idtienda}}" class="panel-collapse collapse show">
            <div class="portlet-body">
                <table class="table tablesaw  " data-tablesaw-mode="stack">
                    <thead>
                        <tr>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">ID</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3">Nombre</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Direccion</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1">Telefono</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">Credencial</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5">Tipo</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="6">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usuarios as $usuario)
                        <tr>
                            <td>{{$usuario->idusuario}}</td>
                            <td>{{$usuario->nombre." ".$usuario->apellido}}</td>
                            <td>{{$usuario->direccion}}</td>
                            <td>{{$usuario->telefono}}</td>
                            <td>{{$usuario->usuario}}</td>
                            <td><span class="badge badge-{{$usuario->tipo->color}}">{{$usuario->tipo->nombre}}</span></td>
                            <td>
                                <div class="pull-right">
                                    <form action="{{ route('usuarios.destroy',  $usuario->idusuario) }}" method="post"> {{ csrf_field() }} {{ method_field('delete') }}
                                        <button type="button" title="Editar" onclick="location.href='{{ route('usuarios.edit', $usuario->idusuario) }}'" class="btn btn-warning"><i class="ti ti-pencil"></i></button>
                                        <button class="btn btn-danger" title="Eliminar" onclick="return confirm('¿seguro que deseas eliminar al usuario {{$usuario->nombre."
                                            ".$usuario->apellido}}?')" type="submit"><i class="ti ti-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9">No se encontró ninguna asignatura</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection