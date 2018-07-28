<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;


class LoginController extends Controller
{
    public function index()
    {
        //dd(Auth::User());
        return view('login');
    }
    public function authlogin(Request $request)
    {
        //dd($request->all());
        $credentials = $request->only('usuario', 'password','recordar');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = Auth::user();
            //dd("hola");
            if ($user->idtipo == 1) {
                return redirect('admin');
            }
            if ($user->idtipo == 2) {
                $this->redirectTo = url()->previous();//LO AGREGAMOS PARA OBTENER LA URL ANTERIOR
                return redirect('admin');
                /** aqui se redirige al perfil de solo ventas */
            }
        } else {
            flash("Usuario o Contraseña Invalido")->error();

            return view('login');
        }
    }
    public function logout()
    {
        Auth::logout();
        flash("Sesión Finalizada")->success();
        return view('login');
    }
    public function check()
    {
        if (Auth::check()) {
            $usuario=Auth::User();
            
            if ($usuario->idtipo == 1) {
                return redirect('admin');
            }
            if ($usuario->idtipo == 2) {
                $this->redirectTo = url()->previous();//LO AGREGAMOS PARA OBTENER LA URL ANTERIOR
                return redirect('venta');
                /** aqui se redirige al perfil de solo ventas */
            }
        }else {
            
            return redirect('login');
        }

    }
}
