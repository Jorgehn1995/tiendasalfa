@extends('admin.layout') 
@section('title', "Inversiones") 
@section('content')
<div class="col-md-12 m-t-15">
    <div class="row">
        <div class="col-lg-12">
            <div class="portlet">
                <div class="portlet-heading portlet-default">
                    <h3 class="portlet-title text-dark">
                        Inversiones
                    </h3>
                    <div class="portlet-widgets">
                        <a data-toggle="collapse" data-parent="#accordion1" href="#inversiones"><i class="ion-minus-round"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="inversiones" class="panel-collapse collapse show">
                    <div class="portlet-body">
                        <div id="cyg" style="height: 250px;"></div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
    <div class="row">
        @forelse($inversiones as $inversion)
        <div class="col-lg-4">
            <div class="portlet">
                <div class="portlet-heading portlet-default">
                    <h3 class="portlet-title text-dark">
                        {{$inversion['nombre']}}
                    </h3>
                    <div class="portlet-widgets">
                        <a data-toggle="collapse" data-parent="#accordion1" href="#portlet{{$inversion['idsucursal']}}"><i class="ion-minus-round"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="portlet{{$inversion['idsucursal']}}" class="panel-collapse collapse show">
                    <div class="portlet-body">
                        <p class="text-right">Articulos en Tienda: {{$inversion['articulos']}}</p>
                        <p class="text-right"><b>Inversión: Q</b> {{$inversion['costos']}}</p>
                        <p class="text-right">Ganancia Prevista: Q {{$inversion['ganancias']}}</p>
                        <hr>
                        <h6 class="text-right">Valor de Sucursal: Q {{$inversion['valor']}}</h6> <br>
                    </div>
                </div>
            </div>
        </div>
        @empty @endforelse

    </div>
</div>
@endsection
 
@section("scripts")
<script>
    $.ajax({
        
        url: 'json/inversiones',
        method: 'get',
        beforeSend: function () {

        },
        success: function (response) {
            barchar('cyg', response, 'nombre', ['costos', 'ganancias','valor'], ['Invertido Q', 'Ganancias Previstas Q', 'Valor de la Sucursal Q'], ['gray', '#52bb56','#00ccff']);
            barchar('unidades', response, 'nombre', ['articulos'], ['Articulos en Sucursal'], ['#ff9933']);
        }
    });

</script>
@endsection