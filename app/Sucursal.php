<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = "sucursales";
    protected $primaryKey ="idsucursal";
    protected $fillable = ['nombre','direccion','telefono','encargado','idtienda'];
    public $timestamps = false;
}
