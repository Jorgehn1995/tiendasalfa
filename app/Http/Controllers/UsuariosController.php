<?php

namespace App\Http\Controllers;
use App\User;
use App\Tipo;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function index(){
        $idtienda=Auth::User()->idtienda;
        $usuarios=User::where("idtienda","=",$idtienda)->where("estado","!=",3)->get();
        
        return view('admin.usuarios.index')->with("usuarios",$usuarios);
    }
    public function create(){
        $tipos=Tipo::get();
        return view('admin.usuarios.create')->with("tipos",$tipos);
    }
    public function store(Request $request){
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'idtipo' => 'required',
            'usuario' => 'required|unique:usuarios',
            'password' => 'required',
        ]);
        $usuario=new User($request->all());
        $usuario->password=bcrypt($request->password);
        $usuario->idtienda=Auth::User()->idtienda;
        $usuario->estado=1;
        $usuario->save();
        Flash::success("El usuario $usuario->nombre $usuario->apellido ha sido agregado exitosamente")->important();
        return redirect()->route("usuarios.index");
    }
    public function edit($id){
        $usuario=User::find($id);
        if(!$usuario || $usuario->idtienda!=Auth::User()->idtienda){
            Flash::warning("El usuario a editar no se encuetra o no tienes autorizacion para editarlo. Error: 0x01");
            return redirect()->route("usuarios.index");
        }
        $tipos=Tipo::get();
        return view('admin.usuarios.edit')->with("item",$usuario)->with("tipos",$tipos);
    }
    public function update(Request $request,$id){
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'idtipo' => 'required',
        ]);
        $credencial=User::where("usuario","=",$request->usuario)->where("idusuario","!=",$id)->count();
        
        if($credencial>0){
            Flash::error("El usuario $request->usuario no se encuentra disponible para su uso, ingrese uno diferente");
            return redirect(URL::previous());
        }
        $usuario=User::find($id);
        if(!$usuario || $usuario->idtienda!=Auth::User()->idtienda){
            Flash::warning("El usuario a editar no se encuetra o no tienes autorizacion para editarlo. Error: 0x02");
            return redirect()->route("usuarios.index");
        }
        $usuario->nombre=$request->nombre;
        $usuario->apellido=$request->apellido;
        $usuario->direccion=$request->direccion;
        $usuario->telefono=$request->telefono;
        $usuario->usuario=$request->usuario;
        $usuario->idtipo=$request->idtipo;
        $usuario->estado=$request->estado;
        $usuario->save();
        Flash::success("El usuario $usuario->nombre $usuario->apellido ha sido editado exitosamente")->important();
        return redirect()->route("usuarios.index");
    }
    public function destroy($id){
        $usuario=User::find($id);
        if(!$usuario || $usuario->idtienda!=Auth::User()->idtienda){
            Flash::warning("El usuario a eliminar no se encuetra o no tienes autorizacion para editarlo. Error: 0x03");
            return redirect()->route("usuarios.index");
        }
        if($usuario->idusuario==Auth::User()->idusuario){
            Flash::warning("No puedes eliminar tu propio usuario")->important();
            return redirect()->route("usuarios.index");
        }
        $usuario->estado=3;
        $usuario->save();
        Flash::success("El usuario $usuario->nombre $usuario->apellido ha sido eliminado exitosamente")->important();
        return redirect()->route("usuarios.index");
    }
}
