<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    protected $table = "detalles";
    protected $primaryKey ="iddetalle";
    protected $fillable = ['costo','venta','ganancia','idventa','idproducto'];
    public $timestamps = true;
}
