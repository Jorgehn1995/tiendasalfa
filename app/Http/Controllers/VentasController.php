<?php

namespace App\Http\Controllers;

use App\Detalle;
use App\Existencia;
use App\Producto;
use App\Sucursal;
use App\Presentacion;
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
        } else {
            $sucursales = Sucursal::where("idtienda", "=", Auth::User()->idtienda)->where("idusuario", "=", Auth::User()->idusuario)->get();
            return view("admin.venta.index")->with("sucursales", $sucursales);
        }

    }
    public function login($id)
    {
        $sucursal = Sucursal::find($id);
        if (!$sucursal) {
            Flash::error("La sucursal no se encuentra")->important();
            return redirect()->route("ventas.index");
        }
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
        $idpresentacion = $request->idpresentacion;
        $producto = Producto::where("barra", "=", $request->barra)->first();
        $existencia = Existencia::where("idproducto", "=", $producto->idproducto)->where("idsucursal", "=", $request->idsucursal)->first();
        if (!$existencia) {
            return "La cantidad actual es: 0";
        }

        if ($request->cantidad > $existencia->existencia) {
            return "La cantidad actual: $existencia->existencia";
        }
        if($idpresentacion!=0){
            $pre=Presentacion::find($idpresentacion);
            if(!$pre){
                return "La presentación selecionada ya no se encuetra disponible";
            }
            $unidades=$pre->cantidad;
            $precio=$pre->precio;
            $npresentacion=$pre->nombre;
        }else{
            $unidades=1;
            $precio=$producto->venta;
            $npresentacion="";
        }
        $temp = new Temp();
        $temp->idusuario = Auth::User()->idusuario;
        $temp->idsucursal = $request->idsucursal;
        $temp->idproducto = $producto->idproducto;
        $temp->barra = $request->barra;
        $temp->nombre = $producto->nombre." ".$npresentacion;
        $temp->costo = ($request->cantidad*$unidades)*$producto->costo;
        $temp->precio = $producto->venta;
        $temp->precioxpre = $precio;
        $temp->unidades=($request->cantidad*$unidades);
        $temp->unidadesxpre=$unidades;
        $temp->cantidad = $request->cantidad;
        $temp->subtotal=($request->cantidad*$unidades)*$producto->venta;
        $temp->descuento=$temp->subtotal-($precio*$temp->cantidad);
        $temp->total = $temp->subtotal-$temp->descuento;
        $temp->ganancia = $temp->total-$temp->costo;
        
        $temp->save();
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
        $venta->ganancias=$request->ganancias-$request->descuento;
        $venta->save();
        $temps = Temp::where("idusuario", "=", Auth::User()->idusuario)->get();
        foreach ($temps as $temp) {
            $detalle = new Detalle();
            $detalle->barra = $temp->barra;
            $detalle->nombre = $temp->nombre;
            $detalle->costo = $temp->costo;
            $detalle->precio = $temp->precio;
            $detalle->precioxpre = $temp->precioxpre;
            $detalle->unidadesxpre = $temp->unidadesxpre;
            $detalle->cantidad = $temp->cantidad;
            $detalle->unidades = $temp->unidades;
            $detalle->subtotal = $temp->subtotal;
            $detalle->descuento = $temp->descuento;
            $detalle->total = $temp->total;
            $detalle->ganancia = $temp->ganancia;
           
            $detalle->idventa = $venta->idventa;
            $detalle->idproducto = $temp->idproducto;
            $detalle->save();
            $existencia = Existencia::where("idproducto", "=", $temp->idproducto)->where("idsucursal", "=", $temp->idsucursal)->first();
            $existencia->existencia = $existencia->existencia - $temp->unidades;
            $existencia->save();
        }
        $this->limpiartemp();
        return "true";
    }
}
