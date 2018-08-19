<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presentacion extends Model
{
    protected $table = "presentaciones";
    protected $primaryKey ="idpresentacion";
    protected $fillable = ['idproducto','nombre','cantidad','precio'];
    public $timestamps = false;
    public function producto(){
        return $this->belongsTo('App\Producto','idproducto');
    }
}
