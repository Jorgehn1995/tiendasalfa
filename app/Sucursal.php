<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = "sucursales";
    protected $primaryKey ="idsucursal";
    protected $fillable = ['nombre','direccion','telefono','idusuario','idtienda'];
    public $timestamps = false;
    public function tienda(){
        return $this->belongsTo('App\Tienda','idtienda');
    }
    public function encargado(){
        return $this->belongsTo('App\User','idusuario');
    }
    public function existencias(){
        return $this->hasMany('App\Existencia','idsucursal');
    }
}
