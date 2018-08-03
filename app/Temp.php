<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temp extends Model
{
    protected $table = "temp";
    protected $primaryKey ="idtemp";
    protected $fillable = ['idusuario','idproducto','barra','nombre','precio','cantidad','total','idsucursal'];
    public $timestamps = false;
    
}
