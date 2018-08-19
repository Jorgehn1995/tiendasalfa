<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Existencia extends Model
{
    protected $table = "existencias";
    protected $primaryKey ="idexistencia";
    protected $fillable = ['existencia','idsucursal','idproducto'];
    public $timestamps = true;
    public function sucursal(){
        return $this->belongsTo('App\Sucursal','idsucursal');
    }
    public function producto(){
        return $this->belongsTo('App\Producto','idproducto');
    }
}
