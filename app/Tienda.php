<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    protected $table = "tiendas";
    protected $primaryKey ="idtienda";
    protected $fillable = ['nombre','direccion','telefono'];
    public $timestamps = false;
}
