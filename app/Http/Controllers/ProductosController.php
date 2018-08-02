<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Producto;
use App\User;
use App\Existencia;
use App\Sucursal;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function index()
    {
        $idtienda = Auth::User()->idtienda;
        $productos = Producto::where('idtienda', '=', Auth::User()->idtienda)->get();
        return view('admin.productos.index')->with("productos", $productos);
    }
    public function create()
    {
        return view('admin.productos.create');
    }
    public function busquedaajax($id)
    {
        $producto = Producto::where('idtienda', '=', Auth::User()->idtienda)->where("barra", "=", $id)->get();
        if (!$producto->all()) {
            $producto = array(array("find" => false, "msg" => "No se encuentra el codigo del producto"));
        } else {
            $date = date("Y-m-d", strtotime($producto[0]["caducidad"]));
            $producto[0]["caducidad"] = $date;
            $producto[0]["find"] = true;
            $producto[0]["msg"] = "No se encuentra el codigo del producto";
            $producto = $producto->all();
        }
        return $producto;
    }
    public function categorias()
    {
        $categorias = Categoria::where('idtienda', '=', Auth::User()->idtienda)->get();
        return $categorias->all();
    }
    public function store(Request $request){
        if($request->metodo=="create"){
            $cod=Producto::where("barra","=",$request->barra)->where('idtienda', '=', Auth::User()->idtienda)->count();
            if($cod>0){
                $response=array(
                    array("error"=>1,"title"=>"Error al Registrar","msg"=>"El codigo ya pertenece a otro producto")
                );
                return $response;
            }
            $producto=new Producto($request->all());
            if($request->caducidad==""){
                $producto->perecedero=0;
            }else{
                $producto->perecedero=1;
            }
            $producto->idtienda=Auth::User()->idtienda;
            $producto->save();
            $response=array(
                array("error"=>0,"title"=>"Operación Exitosa","msg"=>"El producto ha sido ingresado exitosamente","codigo"=>$request->barra)
            );
            return $response;
        }else{
            $cod=Producto::where("idproducto","!=",$request->idproducto)->where("barra","=",$request->barra)->where('idtienda', '=', Auth::User()->idtienda)->count();
            if($cod>0){
                $response=array(
                    array("error"=>1,"title"=>"Error al Actualizar","msg"=>"El codigo ya pertenece a otro producto")
                );
                return $response;
            }
            $producto=Producto::find($request->idproducto);
            $producto->nombre=$request->nombre;
            $producto->costo=$request->costo;
            $producto->venta=$request->venta;
            $producto->caducidad=$request->caducidad;
            $producto->barra=$request->barra;
            $producto->idcategoria=$request->idcategoria;
            if($request->caducidad==""){
                $producto->perecedero=0;
            }else{
                $producto->perecedero=1;
            }
            $producto->save();
            $response=array(
                array("error"=>0,"title"=>"Operación Exitosa","msg"=>"El producto ha sido actualizado exitosamente","codigo"=>$request->barra)
            );
            return $response;
        }
    }
    public function revisarexistencia($id){
        $sucursal=Sucursal::where("idtienda","=",Auth::User()->idtienda)->get();
        //$array=array();
        if($sucursal){
            $index=0;
            foreach($sucursal as $s ){
                $existencia=Existencia::where("idsucursal","=",$s->idsucursal)->where("idproducto","=",$id)->first();
                
                if(!$existencia){
                    
                    $ar=array("idsucursal"=>$s->idsucursal,"nombre"=>$s->nombre,"idexistencia"=>"0","existencia"=>"0","idproducto"=>$id);       
                    $array[$index]=$ar;
                    $index++;
                }else{
                    $ar=array("idsucursal"=>$s->idsucursal,"nombre"=>$s->nombre,"idexistencia"=>$existencia->idexistencia,"existencia"=>$existencia->existencia,"idproducto"=>$id);       
                    $array[$index]=$ar;
                    $index++;
                }
                
            }
        }
        return $array;

    }
    public function agregarexistencia(Request $request){
        $idproducto=$request->idproducto;
        $idsucursal=$request->idsucursal;
        $existencia=$request->existencia;
        $idexistencia=$request->idexistencia;
        if($idexistencia==0){
            $existe=new Existencia($request->all());
            $existe->idtienda =Auth::User()->idtienda;
            $existe->save();
        }else{
            $existe=Existencia::find($idexistencia);
            $existe->existencia+=$existencia;
            $existe->save();
        }
        return "true";
    }
}
