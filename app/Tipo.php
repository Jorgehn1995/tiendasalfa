<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = "tipos";
    protected $primaryKey ="idtipo";
    protected $fillable = ['tipo','nombre'];
    public $timestamps = false;

    public function usuario(){
        return $this->hasMany('App\User','idtipo');
    }
}
