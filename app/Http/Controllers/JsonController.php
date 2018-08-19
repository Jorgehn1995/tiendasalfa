<?php

namespace App\Http\Controllers;

use App\Detalle;
use App\Sucursal;
use App\User;
use App\Venta;
use App\Producto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class JsonController extends Controller
{
    public function sucursal(){
        return view('admin.reportes.sucursal');
    }
    public function detalles($idventa=0)
    {
        $ventas = Detalle::where("idventa", $idventa)->get();
        $gra = array();
        if($ventas->count()==0){
            $nuevo = array(
                'msg' => 'Sin datos encontrados',
                'resultado' => 0,
                'datos'=>0
            );
            array_push($gra, $nuevo);
        }else{
            $nuevo = array(
                'msg' => 'Datos encontrados',
                'resultado' => 1,
                'datos'=>$ventas->all(),
            );
            array_push($gra, $nuevo);
            
        }
        //dd($gra);
        return $gra;
    }
    public function index($sucursal,$intervalo)
    {
        //dd($intervalo);
        $mes=explode(".",$intervalo);
        //dd($mes[1]);
        $datos = array(
            'ventasmes' => $this->ventasmes($sucursal,$mes[0],$mes[1]),
            'masvendidos' => $this->masvendidos($sucursal,$mes[0],$mes[1]),
            'sucursalrentable' => $this->sucursalrentable($sucursal,$mes[0],$mes[1]),
            'mesesrentables' => $this->mesesrentables($sucursal),
            'balancemes' => $this->balancemes($sucursal,$mes[0],$mes[1]),
            'ventas' => $this->ventas($sucursal,$mes[0],$mes[1]),
        );
        //dd($datos);
        return $datos;
    }
    public function ventas($sucursal=0,$inicio = 0,$fin=0 )
    {
        //dd($inicio."/".$fin);
        if($inicio==0 || $fin==0){
            $inicio = date("Y-m") . "-1";
            $fin = date("Y-m-d");
        }
        $fechas = array(
            array("inicio" => $inicio, "fin" => $fin),
        );
        $sucursales = Sucursal::where("idsucursal", $sucursal)->get();
        $ventas = Venta::where("idsucursal", $sucursal)->whereDate("fecha", ">=", $inicio)->whereDate("fecha", "<=", $fin)
            ->get();
        $gra = array();
        if($ventas->count()==0){
            $nuevo = array(
                'msg' => 'Sin datos encontrados',
                'resultado' => 0,
                'datos'=>0
            );
            array_push($gra, $nuevo);
        }else{
            $nuevo = array(
                'msg' => 'Datos encontrados',
                'resultado' => 1,
                'datos'=>$ventas->all(),
            );
            array_push($gra, $nuevo);
            
        }
        //dd($gra);
        return $gra;
    }
    public function balancemes($sucursal,$inicio = 0,$fin=0 )
    {
        if($inicio==0 || $fin==0){
            $inicio = date("Y-m") . "-1";
            $fin = date("Y-m-d");
        }
        
        $fechas = array(
            array("inicio" => $inicio, "fin" => $fin),
        );
        $sucursales = Sucursal::where("idsucursal", $sucursal)->get();
        $ventas = Venta::where("idsucursal", $sucursal)->whereDate("fecha", ">=", $inicio)->whereDate("fecha", "<=", $fin)
            ->get();
        
        $gra = array();
        $nuevo=array(
            "total"=>round($ventas->sum("total"),2),
            "costos"=>round($ventas->sum("costos"),2),
            "ganancias"=>round($ventas->sum("ganancias"),2),
            "sucursales"=>$ventas->count(),
        );
        
        return $nuevo;
    }
    public function mesesrentables($sucursal=0)
    {
        $meses=array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
        $gra = array();
        for ($i = 0; $i < 12; $i++) {
            //echo    $i;

            $ventas = Venta::where("idsucursal", "=", $sucursal)->whereMonth("fecha", "=", $i+1)
            ->get()->groupBy(function ($val) {
            return Carbon::parse($val->fecha)->format('m');
        });
            $total=$ventas->count();
            
            if ($total==0) {
                $nuevo = array(
                    'mes' => $i+1,
                    'nmes'=> $meses[$i],
                    'costos' => 0,
                    
                    'ganancias' => 0,
                    'total' => 0,
                    'vacio'=>'true',
                );
            } else {
                foreach ($ventas->all() as $venta) {
                    $dd = $venta->all();
                    $total = array_sum(array_column($dd, 'total'));
                    $costos = array_sum(array_column($dd, 'costos'));
                    $ganancias = array_sum(array_column($dd, 'ganancias'));
                    $nuevo = array(
                        'mes' => $i+1,
                        'nmes'=> $meses[$i],
                        'costos' => round($costos,2),
                        'ganancias' => round($ganancias,2),
                        'total' => round($total,2),
                        'vacio'=>'false',
                    );   
                }
            }
            array_push($gra, $nuevo);
        }
        //exit();
        return $gra;
    }
    public function sucursalrentable($sucursal=0,$inicio = 0,$fin=0 )
    {
        if($inicio==0 || $fin==0){
            $inicio = date("Y") . "-01-01";
            $fin = date("Y-m-d");
        }
        $ventas = Venta::where("idsucursal", $sucursal)->whereDate("fecha", ">=", $inicio)->whereDate("fecha", "<=", $fin)
            ->get()->groupBy('idsucursal');
        $gra = array();
        if($ventas->count()==0){
            $nuevo = array(
                'idsucursal' => '0',
                'nombre' => 'Sin datos encontrados',
                'costos' => 0,
                'ganancias' => 0,
                'total' => 0,
            );
            array_push($gra, $nuevo);
        }
        foreach ($ventas->all() as $venta) {
            $dd = $venta->all();
            $total = array_sum(array_column($dd, 'total'));
            $costos = array_sum(array_column($dd, 'costos'));
            $ganancias = array_sum(array_column($dd, 'ganancias'));
            $idsucursal = $dd[0]['idsucursal'];
            $sucursal = Sucursal::find($idsucursal);
            $nuevo = array(
                'idsucursal' => $sucursal->idsucursal,
                'nombre' => $sucursal->nombre,
                'costos' => round($costos,2),
                'ganancias' => round($ganancias,2),
                'total' => round($total,2),
            );
            array_push($gra, $nuevo);
        }
        return $gra;
    }
    public function masvendidos($sucursal=0,$inicio = 0,$fin=0 )
    {
        if($inicio==0 || $fin==0){
            $inicio = date("Y-m") . "-1";
            $fin = date("Y-m-d");
        }
        
        $productos = Detalle::join('ventas', 'detalles.idventa', '=', 'ventas.idventa')
            ->where("ventas.idsucursal", $sucursal)
            ->whereDate("fecha", ">=", $inicio)->whereDate("fecha", "<=", $fin)->orderBy('unidades','DESC')
            ->get()
            ->groupBy('idproducto');
            //dd($productos);
        $gra = array();
        
        foreach ($productos as $producto) {
            $dd = $producto->all();
            $total = array_sum(array_column($dd, 'unidades'));
            $idproducto = $dd[0]['idproducto'];
            $pro=Producto::find($idproducto);
            $nuevo = array(
                'idproducto' => $idproducto,
                'nombre'=>$pro->nombre,
                'barra'=>$pro->barra,
                'uvendidas' => $total,
            );
            array_push($gra, $nuevo);
        }
        return $gra;
    }
    public function ventasmes($sucursal=0,$inicio = 0,$fin=0 )
    {
        //dd($inicio."/".$fin);
        if($inicio==0 || $fin==0){
            $inicio = date("Y-m") . "-1";
            $fin = date("Y-m-d");
        }
        $fechas = array(
            array("inicio" => $inicio, "fin" => $fin),
        );
        $sucursales = Sucursal::where("idsucursal", $sucursal)->get();
        $ventas = Venta::where("idsucursal", $sucursal)->whereDate("fecha", ">=", $inicio)->whereDate("fecha", "<=", $fin)
            ->get()->groupBy(function ($val) {
            return Carbon::parse($val->fecha)->format('d/m/Y');
        });
        $gra = array();
        if($ventas->count()==0){
            $nuevo = array(
                'fecha' => 'Sin datos encontrados',
                'costos'=>0,
                'ganancias'=>0,
                'total' => 0,
            );
            array_push($gra, $nuevo);
        }
        foreach ($ventas->all() as $venta) {
            $dd = $venta->all();
            $total = array_sum(array_column($dd, 'total'));
            $costos = array_sum(array_column($dd, 'costos'));
            $ganancias = array_sum(array_column($dd, 'ganancias'));
            $dia = date("d/m/Y", strtotime($dd[0]['fecha']));
            $nuevo = array(
                'fecha' => $dia,
                'costos'=>round($costos,2),
                'ganancias'=>round($ganancias,2),
                'total' => round($total,2),
            );
            array_push($gra, $nuevo);
        }
        return $gra;
    }
}
