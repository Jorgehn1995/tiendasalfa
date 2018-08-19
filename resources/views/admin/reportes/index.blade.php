@extends('admin.layout') 
@section('title', "Ventas :. Selecione Sucursal") 
@section('content')
<div class="col-md-12 m-t-15">
        <div class="row">
    @foreach($sucursales as $sucursal)
    
            <article class="pricing-column col-md-4">
                    <div class="inner-box card-box">
                        <div class="plan-header text-center">
                            <h3 class="plan-title">Reporte Diario </h3>
                            <h2 class="plan-price"><i class=" ti-shopping-cart text-success"></i></h2>
                            <div class="plan-duration">
                                <h3>{{$sucursal->nombre}} </h3>
                            </div>
                        </div>
            
                        <div class="text-center">
                            <a href="{{route("reportes.dia",$sucursal->idsucursal)}}" class="btn btn-primary btn-bordred btn-rounded waves-effect waves-light">Ver Reporte</a>
                        </div>
                    </div>
                </article>
    
    @endforeach
</div>
</div>
@endsection