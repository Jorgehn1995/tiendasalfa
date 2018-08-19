<?php

namespace App\Http\Controllers;

use App\Existencia;
use App\Producto;
use App\Sucursal;
use App\User;
use App\Venta;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class ReportesController extends Controller
{
    public function index()
    {
        if (Auth::User()->idtipo == 1) {
            $sucursales = Sucursal::where("idtienda", "=", Auth::User()->idtienda)->get();
            return view("admin.reportes.index")->with("sucursales", $sucursales);
        } else {
            $sucursales = Sucursal::where("idtienda", "=", Auth::User()->idtienda)->where("idusuario", "=", Auth::User()->idusuario)->get();
            return view("admin.reportes.index")->with("sucursales", $sucursales);
        }
    }
    public function dia($id)
    {
        $sucursal = Sucursal::find($id);
        if (!$sucursal) {
            Flash::error("La sucursal no se encuentra")->important();
            return redirect()->route("reportes.index");
        }
        $ventas = Venta::where("idsucursal", "=", $id)->whereDate("fecha", "=", date("Y-m-d"))->get();
        return view("admin.reportes.dia")->with("ventas", $ventas)->with("sucursal", $sucursal);
    }
    public function jsonfechados($idsucursal, $inicio, $fin)
    {
        //dd($inicio."/".$fin);
        $inicio = date("Y-m-d", strtotime($inicio));
        $fin = date("Y-m-d", strtotime($fin));

        $sucursal = Sucursal::find($idsucursal);
        if (!$sucursal) {
            $idsucursal = 0;
        }
        $fechas = array(
            array("inicio" => $inicio, "fin" => $fin, "idsucursal" => $idsucursal),

        );
        $sucursales = Sucursal::where("idtienda", "=", Auth::User()->idtienda)->get();
        $ventas = Venta::where("idsucursal", "=", $idsucursal)->whereDate("fecha", ">", $inicio)->whereDate("fecha", "<", $fin)
            ->get()->groupBy(function ($val) {
            return Carbon::parse($val->fecha)->format('d/m/Y');
        });
        $gra=array();
        foreach ($ventas->all() as $venta ) {
            $dd = $venta->all();
            $total=array_sum(array_column($dd, 'total'));
            
            $dia=date("d/m/Y",strtotime($dd[0]['fecha']));
            $nuevo=array(
                'fecha'=>$dia,
                'total'=>$total
            );
            array_push($gra,$nuevo);
        }
        return $gra;
        
    }
    public function fechados($idsucursal, $inicio, $fin)
    {
        //dd($inicio."/".$fin);
        $inicio = date("Y-m-d", strtotime($inicio));
        $fin = date("Y-m-d", strtotime($fin));

        $sucursal = Sucursal::find($idsucursal);
        if (!$sucursal) {
            $idsucursal = 0;
        }
        $fechas = array(
            array("inicio" => $inicio, "fin" => $fin, "idsucursal" => $idsucursal),

        );
        $sucursales = Sucursal::where("idtienda", "=", Auth::User()->idtienda)->get();
        $ventas = Venta::where("idsucursal", "=", $idsucursal)->whereDate("fecha", ">", $inicio)->whereDate("fecha", "<", $fin)->get();
        return view("admin.reportes.fechados")->with("ventas", $ventas)->with("fechas", $fechas)->with("sucursales", $sucursales);
    }
    public function jsoninversiones()
    {
        
        $idtienda = Auth::User()->idtienda;
        $sucursales = Sucursal::where("idtienda", $idtienda)->get();
        $inversiones = array();
        foreach ($sucursales as $sucursal) {
            $exi = 0;
            $costo = 0;
            $precio = 0;
            $inver = 0;
            $ganancia = 0;
            $valor = 0;
            $produc=0;
            $ct=0;
            $unit=0;
            $gt=0;
            //dd($sucursal->existencias);
            foreach ($sucursal->existencias as $existencia) {
                $produc++;
                $exi = $existencia->existencia;
                $costo = $existencia->producto->costo;
                $precio= $existencia->producto->venta;

                $inver = $exi * $costo;
                $ganancia=($precio-$costo)*$exi;
                $unit+=$exi;
                $ct+=$inver;
                $gt+=$ganancia;
            }
            $valor = $ct + $gt;
            $inv = array(
                "idsucursal" => $sucursal->idsucursal,
                "nombre" => $sucursal->nombre,
                "articulos" => $unit,
                "costos" => round($ct, 2),
                "ganancias" => round($gt, 2),
                "valor" => round($valor, 2),
            );
            array_push($inversiones, $inv);
        }
        //dd($inversiones);
        return $inversiones;
    }
    public function inversiones()
    {

        return view("admin.reportes.inversiones")->with("inversiones", $this->jsoninversiones());
    }
}
