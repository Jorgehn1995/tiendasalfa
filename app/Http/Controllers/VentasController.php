<?php

namespace App\Http\Controllers;

use App\Detalle;
use App\Existencia;
use App\Producto;
use App\Sucursal;
use App\Temp;
use App\User;
use App\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class VentasController extends Controller
{
    public function index()
    {
        if (Auth::User()->idtipo == 1) {
            $sucursales = Sucursal::where("idtienda", "=", Auth::User()->idtienda)->get();
            return view("admin.venta.index")->with("sucursales", $sucursales);
        }else{
            $sucursales = Sucursal::where("idtienda", "=", Auth::User()->idtienda)->where("idusuario", "=", Auth::User()->idusuario)->get();
            return view("admin.venta.index")->with("sucursales", $sucursales);
        }

    }
    public function login($id)
    {
        if (Auth::User()->idtipo == 1) {
            $sucursal = Sucursal::find($id);
            $productos = Producto::where("idtienda", "=", Auth::User()->idtienda)->get();
            return view("admin.venta.login")->with("sucursal", $sucursal)->with("productos", $productos);
        } else {
            if (!Auth::User()->idsucursal) {
                Flash::success("no tienes acceso a la seccino solicitada");
                return route("admin.index");
            } else {
                $sucursal = Sucursal::find(Auth::User()->idsucursal);
                return view("admin.venta.login")->with("sucursal", $sucursal);
            }
        }
    }
    public function temp()
    {
        $temp = Temp::where("idusuario", "=", Auth::User()->idusuario)->get();
        if (!$temp->all()) {
            return "false";
        }
        return $temp;
    }
    public function seektotemp(Request $request)
    {
        $producto = Producto::where("barra", "=", $request->barra)->first();
        $existencia = Existencia::where("idproducto", "=", $producto->idproducto)->where("idsucursal", "=", $request->idsucursal)->first();
        if (!$existencia) {
            return "La cantidad actual es: 0";
        }
        if ($request->cantidad > $existencia->existencia) {
            return "La cantidad actual: $existencia->existencia";
        }
        $temp = Temp::where("idusuario", "=", Auth::User()->idusuario)->where("idproducto", "=", $producto->idproducto)->where("idsucursal", "=", $request->idsucursal)->count();

        if (!$temp) {
            $temp = new Temp();
            $temp->idusuario = Auth::User()->idusuario;
            $temp->idsucursal = $request->idsucursal;
            $temp->idproducto = $producto->idproducto;
            $temp->barra = $request->barra;
            $temp->nombre = $producto->nombre;

            $temp->precio = $producto->venta;
            $temp->total = ($producto->venta * $request->cantidad);
            $temp->costo = $producto->costo;
            $temp->ganancia = $producto->venta - $producto->costo;
            $temp->cantidad = $request->cantidad;
            $temp->save();
            return "true";
        }
        $temp = Temp::where("idusuario", "=", Auth::User()->idusuario)->where("idproducto", "=", $producto->idproducto)->where("idsucursal", "=", $request->idsucursal)->first();
        $temp->idusuario = Auth::User()->idusuario;
        $temp->idsucursal = $request->idsucursal;
        $temp->idproducto = $producto->idproducto;
        $temp->barra = $request->barra;
        $temp->nombre = $producto->nombre;
        $temp->precio = $producto->venta;
        $temp->cantidad = $temp->cantidad + $request->cantidad;

        $temp->costo = ($producto->costo * $temp->cantidad);
        $temp->ganancia = ($producto->venta - $producto->costo) * $temp->cantidad;

        $temp->total = ($producto->venta * $temp->cantidad);
        if ($temp->cantidad == 0) {
            $temp->delete();
        } else {
            $temp->save();
        }
        return "true";
    }
    public function limpiartemp()
    {
        $productos = Temp::where("idusuario", "=", Auth::User()->idusuario)->delete();
    }
    public function procesar(Request $request)
    {
        $date = date("Y-m-d h:i:s");
        $venta = new Venta($request->all());
        $venta->fecha = $date;
        $venta->idtienda = Auth::User()->idtienda;
        $venta->save();
        $temps = Temp::where("idusuario", "=", Auth::User()->idusuario)->get();
        foreach ($temps as $temp) {
            $detalle = new Detalle();
            $detalle->costo = $temp->costo;
            $detalle->venta = $temp->precio;
            $detalle->ganancia = $temp->ganancia;
            $detalle->cantidad = $temp->cantidad;
            $detalle->total = $temp->total;
            $detalle->idventa = $venta->idventa;
            $detalle->idproducto = $temp->idproducto;
            $detalle->save();
            $existencia = Existencia::where("idproducto", "=", $temp->idproducto)->where("idsucursal", "=", $temp->idsucursal)->first();
            $existencia->existencia = $existencia->existencia - $temp->cantidad;
            $existencia->save();
        }
        $this->limpiartemp();
        return "true";
    }
}
