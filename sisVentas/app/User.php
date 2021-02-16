<?php

namespace sisVentas;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $table='users';//aqui defino la tabla del modelo
    protected $primarykey='id';//aqui defino la primarykey del modelo
   
    protected $fillable = [
        'name', 'email', 'password',
    ];

  
    protected $hidden = [
        'password', 'remember_token',
    ];
}
