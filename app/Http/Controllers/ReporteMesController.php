<?php

namespace App\Http\Controllers;
use App\Detalle;
use App\Sucursal;
use App\User;
use App\Venta;
use App\Producto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReporteMesController extends Controller
{
    public function sucursal(){
        $sucursales=Sucursal::where("idtienda",Auth::User()->idtienda)->get();
        return view('admin.reportes.sucursal')->with("sucursales",$sucursales);
    }
    public function index()
    {
        $datos = array(
            'ventasmes' => $this->ventasmes(),
            'masvendidos' => $this->masvendidos(),
            'sucursalrentable' => $this->sucursalrentable(),
            'mesesrentables' => $this->mesesrentables(),
            'balancemes' => $this->balancemes(),
        );
        //dd($datos);
        return $datos;
    }
    public function balancemes()
    {
        //dd($inicio."/".$fin);
        $inicio = date("Y-m") . "-1";
        $fin = date("Y-m-d");
        $fechas = array(
            array("inicio" => $inicio, "fin" => $fin),
        );
        $sucursales = Sucursal::where("idtienda", "=", Auth::User()->idtienda)->get();
        $ventas = Venta::where("idtienda", "=", Auth::User()->idtienda)->whereDate("fecha", ">", $inicio)->whereDate("fecha", "<=", $fin)
            ->get();
        
        $gra = array();
        $nuevo=array(
            "total"=>round($ventas->sum("total"),2),
            "costos"=>round($ventas->sum("costos"),2),
            "ganancias"=>round($ventas->sum("ganancias"),2),
            "sucursales"=>$sucursales->count(),
        );
        
        return $nuevo;
    }
    public function mesesrentables()
    {
        $meses=array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
        $gra = array();
        for ($i = 0; $i < 12; $i++) {
            //echo    $i;

            $ventas = Venta::where("idtienda", "=", Auth::User()->idtienda)->whereMonth("fecha", "=", $i+1)
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
    public function sucursalrentable()
    {
        $inicio = date("Y") . "-01-01";
        $fin = date("Y-m-d");
        $ventas = Venta::where("idtienda", "=", Auth::User()->idtienda)->whereDate("fecha", ">", $inicio)->whereDate("fecha", "<=", $fin)
            ->get()->groupBy('idsucursal');
        $gra = array();
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
    public function masvendidos()
    {
        $inicio = date("Y-m") . "-1";
        $fin = date("Y-m-d");
        $productos = Detalle::join('ventas', 'detalles.idventa', '=', 'ventas.idventa')
            ->where("ventas.idtienda", Auth::User()->idtienda)
            ->whereDate("fecha", ">", $inicio)->whereDate("fecha", "<=", $fin)->orderBy('unidades','DESC')
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
    public function ventasmes()
    {
        //dd($inicio."/".$fin);
        $inicio = date("Y-m") . "-1";
        $fin = date("Y-m-d");
        $fechas = array(
            array("inicio" => $inicio, "fin" => $fin),
        );
        $sucursales = Sucursal::where("idtienda", "=", Auth::User()->idtienda)->get();
        $ventas = Venta::where("idtienda", "=", Auth::User()->idtienda)->whereDate("fecha", ">", $inicio)->whereDate("fecha", "<=", $fin)
            ->get()->groupBy(function ($val) {
            return Carbon::parse($val->fecha)->format('d/m/Y');
        });
        $gra = array();
        foreach ($ventas->all() as $venta) {
            $dd = $venta->all();
            $total = array_sum(array_column($dd, 'total'));
            $dia = date("d/m/Y", strtotime($dd[0]['fecha']));
            $nuevo = array(
                'fecha' => $dia,
                'total' => $total,
            );
            array_push($gra, $nuevo);
        }
        return $gra;
    }
}
