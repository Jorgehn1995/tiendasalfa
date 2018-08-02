<?php

namespace App\Http\Controllers;

use App\User;
use App\Sucursal;
use App\Tienda;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

class SucursalesController extends Controller
{
    public function index(){
        $idtienda=Auth::User()->idtienda;
        $tienda=Tienda::find(Auth::User()->idtienda);
        return view('admin.sucursales.index')->with("sucursales",$tienda->sucursales);
    }
    public function create(){
        $usuarios=User::where("estado","!=",3)->where("idtienda","=",Auth::User()->idtienda)->get();
        return view('admin.sucursales.create')->with("usuarios",$usuarios);
    }
    public function store(Request $request){
        $request->validate([
            'nombre' => 'required',
            'idusuario' => 'required',
        ]);
        $sucursal=new Sucursal($request->all());
        $sucursal->idtienda=Auth::User()->idtienda;
        $sucursal->save();
        Flash::success("La sucursal $sucursal->nombre ha sido agregada exitosamente")->important();
        return redirect()->route("sucursales.index");
    }
    public function edit($id){
        $items=Sucursal::find($id);
        if(!$items || $items->idtienda!=Auth::User()->idtienda){
            Flash::warning("La sucursa a editar no se encuetra o no tienes autorizacion para editarlo. Error: 0x04");
            return redirect()->route("sucursales.index");
        }
        $usuarios=User::where("estado","!=",3)->where("idtienda","=",Auth::User()->idtienda)->get();
        return view('admin.sucursales.edit')->with("item",$items)->with("usuarios",$usuarios);
    }
    public function update(Request $request,$id){
        $request->validate([
            'nombre' => 'required',
            'idusuario' => 'required',
        ]);
        
        $sucursal=Sucursal::find($id);
        if(!$sucursal || $sucursal->idtienda!=Auth::User()->idtienda){
            Flash::warning("La sucursal a editar no se encuetra o no tienes autorizacion para editarlo. Error: 0x05");
            return redirect()->route("usuarios.index");
        }
        $sucursal->nombre=$request->nombre;
        $sucursal->direccion=$request->direccion;
        $sucursal->telefono=$request->telefono;
        $sucursal->idusuario=$request->idusuario;
        $sucursal->save();
        Flash::success("La sucursals $sucursal->nombre ha sido editada exitosamente")->important();
        return redirect()->route("sucursales.index");
    }
    public function destroy($id){
        $sucursal=Sucursal::find($id);
        if(!$sucursal || $sucursal->idtienda!=Auth::User()->idtienda){
            Flash::warning("La sucursal a editar no se encuetra o no tienes autorizacion para editarlo. Error: 0x05");
            return redirect()->route("usuarios.index");
        }
        $sucursal->estado=0;
        $sucursal->delete();
        Flash::info("La sucursals $sucursal->nombre ha sido eliminada exitosamente")->important();
        return redirect()->route("sucursales.index");
    }
}
