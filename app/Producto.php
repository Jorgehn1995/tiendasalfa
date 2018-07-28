<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "productos";
    protected $primaryKey ="idproducto";
    protected $fillable = ['nombre','costo','venta','perecedero','caducidad','barra','idcategoria'];
    public $timestamps = true;
}
