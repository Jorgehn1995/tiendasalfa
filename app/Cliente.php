<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "clientes";
    protected $primaryKey ="idcliente";
    protected $fillable = ['nit','nombre','direccion','telefono'];
    public $timestamps = true;
}
