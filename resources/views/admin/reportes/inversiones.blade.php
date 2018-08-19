@extends('admin.layout') 
@section('title', "Inversiones") 
@section('content')
<div class="col-lg-3  col-md-3">
    <div class="widget-bg-color-icon card-box">
        <div class="bg-icon bg-icon-primary pull-left">
            <i class=" ti-bag text-success"></i>
        </div>
        <div class="text-right">
            <h5 class="text-dark m-t-10"><b class="counter" id="nsucursal"></b></h5>
            <p class="text-muted mb-0">Sucursales</p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="col-lg-3  col-md-3">
    <div class="widget-bg-color-icon card-box">
        <div class="bg-icon bg-icon-danger pull-left">
            <i class="ti-package text-success"></i>
        </div>
        <div class="text-right">
            <h5 class="text-dark m-t-10">Q <b class="counter" id="ncostos"></b></h5>
            <p class="text-muted mb-0">Invertido</p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="col-lg-3  col-md-3">
    <div class="widget-bg-color-icon card-box">
        <div class="bg-icon bg-icon-success pull-left">
            <i class=" ti-stats-up text-success"></i>
        </div>
        <div class="text-right">
            <h5 class="text-dark m-t-10">Q <b class="counter" id="nganancias"></b></h5>
            <p class="text-muted mb-0">Ganancias</p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="col-lg-3  col-md-3">
    <div class="widget-bg-color-icon card-box">
        <div class="bg-icon bg-icon-info pull-left">
            <i class="  ti-money text-success"></i>
        </div>
        <div class="text-right">
            <h5 class="text-dark m-t-10">Q <b class="counter" id="ningresos"></b></h5>
            <p class="text-muted mb-0">Valor</p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="col-md-6  col-print-6">
    <div class="portlet">
        <!-- /primary heading -->
        <div class="portlet-heading">
            <h3 class="portlet-title text-dark"> Balance</h3>
            <div class="portlet-widgets">
                <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                <span class="divider"></span>
                <a data-toggle="collapse" data-parent="#accordion1" href="#prtbalance"><i class="ion-minus-round"></i></a>

            </div>
            <div class="clearfix"></div>
        </div>
        <div id="prtbalance" class="panel-collapse collapse show">
            <div class="portlet-body">
                <div class="text-center">
                    <ul class="list-inline chart-detail-list">

                        <li class="list-inline-item">
                            <h5><i class="fa fa-circle m-r-5" style="color: #f2f2f2;"></i>Costos</h5>
                        </li>
                        <li class="list-inline-item">
                            <h5><i class="fa fa-circle m-r-5" style="color: #00cc00;"></i>Ganancias</h5>
                        </li>
                        <li class="list-inline-item">
                            <h5><i class="fa fa-circle m-r-5" style="color: #1ad1ff;"></i>Ingresos</h5>
                        </li>
                    </ul>
                </div>
                <div id="balance" style="height: 300px;"></div>
            </div>
        </div>
    </div>
    <!-- /Portlet -->
</div>
<div class="col-md-6  col-print-6">
    <div class="portlet">
        <!-- /primary heading -->
        <div class="portlet-heading">
            <h3 class="portlet-title text-dark">Margen Ganancia %</h3>
            <div class="portlet-widgets">
                <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                <span class="divider"></span>
                <a data-toggle="collapse" data-parent="#accordion1" href="#prtganancia"><i class="ion-minus-round"></i></a>

            </div>
            <div class="clearfix"></div>
        </div>
        <div id="prtganancia" class="panel-collapse collapse show">
            <div class="portlet-body">
                <div id="cyg" style="height: 300px;"></div>
                <div class="text-center">
                    <ul class="list-inline chart-detail-list">

                        <li class="list-inline-item">
                            <h5><i class="fa fa-circle m-r-5" style="color: #f2f2f2;"></i>Invertido</h5>
                        </li>
                        <li class="list-inline-item">
                            <h5><i class="fa fa-circle m-r-5" style="color: #00cc00;"></i>Ganancias Previstas</h5>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <!-- /Portlet -->
</div>
@forelse($inversiones as $inversion)
<div class="col-lg-4">
    <div class="portlet">
        <div class="portlet-heading portlet-default">
            <h5 class="portlet-title text-dark">
                {{$inversion['nombre']}}
            </h5>
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
                <h5 class="text-right">Valor de Sucursal: Q {{$inversion['valor']}}</h5> <br>
            </div>
        </div>
    </div>
</div>
@empty @endforelse
@endsection
 
@section("scripts")
<script>
    function concomas(num) {
        if (!num || num == 'NaN') return '-';
        if (num == 'Infinity') return '&#x221e;';
        num = num.toString().replace(/\$|\,/g, '');
        if (isNaN(num))
            num = "0";
        sign = (num == (num = Math.abs(num)));
        num = Math.floor(num * 100 + 0.50000000001);
        cents = num % 100;
        num = Math.floor(num / 100).toString();
        if (cents < 10)
            cents = "0" + cents;
        for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3) ; i++)
            num = num.substring(0, num.length - (4 * i + 3)) + ',' + num.substring(num.length - (4 * i + 3));
        return (((sign) ? '' : '-') + num + '.' + cents);
    }
    $.ajax({
        
        url: 'json/inversiones',
        method: 'get',
        beforeSend: function () {

        },
        success: function (response) {
            //console.log(response);
            var i=0;
            var sucursales=0;
            var invertido=0;
            var ganancias=0;
            var valor=0;
            $.each( response, function( i, item ) {
                i++;
                sucursales++;
                invertido+=item['costos'];
                ganancias+=item['ganancias'];
                valor+=item['valor'];
            });
            $("#nsucursal").text(sucursales);
            $("#ncostos").text(concomas(invertido));
            $("#nganancias").text(concomas(ganancias));
            $("#ningresos").text(concomas(valor));
            
            
          var $donutData = [
                {label: "Invertido", value: invertido},
                {label: "Ganancia", value: ganancias},
            ];
            donutchar('cyg', $donutData, ['#f2f2f2', '#52bb56']);
            //barchar('cyg', $data, 'y', ['a', 'b','c'], ['Invertido Q', 'Ganancias Previstas Q', 'Valor Total Q'], ['#f2f2f2', '#52bb56','#00ccff'],false);
            barchar('balance', response, 'nombre', ['costos', 'ganancias','valor'], ['Invertido Q', 'Ganancias Previstas Q', 'Valor de la Sucursal Q'], ['gray', '#52bb56','#00ccff'],false);
            counterup();
        }
    });

</script>
@endsection