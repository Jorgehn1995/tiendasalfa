@extends('admin.layout') 
@section('title', "Sucursales") 
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
                <button type="button" onclick="location.href='{{ route('sucursales.create')}}'" class="btn btn-success"><i class="ti-plus"></i> Agregar @yield('title') </button>
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
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">Encargado</th>
                            
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="6">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sucursales as $sucursal)
                        <tr>
                            <td>{{$sucursal->idsucursal}}</td>
                            <td>{{$sucursal->nombre}}</td>
                            <td>{{$sucursal->direccion}}</td>
                            <td>{{$sucursal->telefono}}</td>
                            <td>{{$sucursal->encargado->nombre." ".$sucursal->encargado->apellido}}</td>
                            <td>
                                <div class="pull-right">
                                    <form action="{{ route('sucursales.destroy',  $sucursal->idsucursal) }}" method="post"> {{ csrf_field() }} {{ method_field('delete') }}
                                        <button type="button" title="Editar" onclick="location.href='{{ route('sucursales.edit', $sucursal->idsucursal) }}'" class="btn btn-warning"><i class="ti ti-pencil"></i></button>
                                        <button class="btn btn-danger" title="Eliminar" onclick="return confirm('¿seguro que deseas eliminar la sucursal {{$sucursal->nombre}}?')" type="submit"><i class="ti ti-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">No se encontraron @yield('title')</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection