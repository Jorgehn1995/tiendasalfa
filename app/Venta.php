<?php

namespace App;




use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = "ventas";
    protected $primaryKey ="idventa";
    protected $fillable = ['fecha','subtotal','descuento','total','costos','ganancias','idcaja','idsucursal','idtienda','idcliente'];
    public $timestamps = true;
}
