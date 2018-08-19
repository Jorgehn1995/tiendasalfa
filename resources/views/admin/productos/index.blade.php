@extends('admin.layout') 
@section('title', "Productos") 
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
                <button type="button" onclick="location.href='{{ route('productos.create')}}'" class="btn btn-success"><i class="ti-plus"></i> Agregar @yield('title') </button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div id="tab{{Auth::User()->idtienda}}" class="panel-collapse collapse show">
            <div class="portlet-body">
                <table id="productos" class="table   " data-tablesaw-mode="stack">
                    <thead>
                        <tr>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">ID</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3">Nombre</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Costo</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1">Venta</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">Ganancia</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">Caducidad</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productos as $producto)
                        <tr>
                            <td>{{$producto->barra}}</td>
                            <td>{{$producto->nombre}}</td>
                            <td>{{$producto->costo}}</td>
                            <td>{{$producto->venta}}</td>
                            <td>{{$producto->venta-$producto->costo}}</td>
                            <td>{{($producto->perecedero==0 )?"No Perecedero":date("d/m/Y",strtotime($producto->caducidad))}} @if(((strtotime($producto->caducidad)-strtotime(date("Y-m-d")))/86400)<32 && $producto->perecedero==1) <span class="badge badge-danger">{{" (".((strtotime($producto->caducidad)-strtotime(date("Y-m-d")))/86400)." días)"}}</span> @endif </td>
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
@section("scripts")
<script>
    productos();
</script>
@endsection