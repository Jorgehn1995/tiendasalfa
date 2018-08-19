<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "productos";
    protected $primaryKey ="idproducto";
    protected $fillable = ['nombre','costo','venta','perecedero','caducidad','barra','idcategoria'];
    public $timestamps = true;
    public function detalles(){
        return $this->hasMany('App\Detalle','idproducto');
    }
    public function presentaciones(){
        return $this->hasMany('App\Presentacion','idproducto');
    }
    public function existencias(){
        return $this->hasMany('App\Existencia','idproducto');
    }
}
