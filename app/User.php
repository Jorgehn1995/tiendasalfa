<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="usuarios";
    protected $primaryKey="idusuario";
    protected $fillable = [
        'nombre','apellido','direccion','telefono', 'usuario','idtipo','idtienda','idsucursal'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tipo(){
        return $this->belongsTo('App\Tipo','idtipo');
    }
    public function sucursales(){
        return $this->hasMany('App\Sucursal','idusuario');
    }
}
