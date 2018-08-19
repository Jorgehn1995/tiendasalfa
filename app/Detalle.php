<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    protected $table = "detalles";
    protected $primaryKey ="iddetalle";
    protected $fillable = ['costo','venta','ganancia','idventa','idproducto'];
    public $timestamps = true;
    public function venta(){
        return $this->belongsTo('App\Venta','idventa');
    }
    public function producto(){
        return $this->belongsTo('App\Producto','idproducto');
    }
}
