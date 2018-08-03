<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Producto;
use App\User;
use App\Existencia;
use App\Sucursal;
use App\Temp;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    public function login($id){
        if(Auth::User()->idtipo==1){
            $sucursal=Sucursal::find($id);
            return view("admin.venta.login")->with("sucursal",$sucursal);
        }else{
            if(!Auth::User()->idsucursal){
                Flash::success("no tienes acceso a la seccino solicitada");
                return route("admin.index");
            }else{
                $sucursal=Sucursal::find(Auth::User()->idsucursal);
                return view("admin.venta.login")->with("sucursal",$sucursal);
            }
        }   
    }
    public function temp(){
        $temp=Temp::where("idusuario","=",Auth::User()->idusuario)->get();
        if(!$temp->all()){
            return "false";
        }
        return $temp;
    }
}
