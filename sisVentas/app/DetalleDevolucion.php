<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class DetalleDevolucion extends Model
{
    //Definimos la tabla a la que va hacer referencia este modelo

	Protected $table='detalle_devolucion';

	// Definimos el atributo que va hacer primarykey del modelo

	protected $primaryKey="iddetalle_devolucion";

	//Laravel nos permite adicional a la tabla dos columnas,Estas columna nos va a permitir saber cuando ha sido creado o modifocado el registro. en este caso la colocamos en false porq no la vamos autilizar.

	public $timestamps=false;

	//Ahora definimos los campos que van a recibir un valor para poder almacenarlos en la base de datos.

	protected $fillable =[
	'iddevolucion',
	'iddetalle_venta'		
	
	];


// Este tipo de campo se van a esepcificar cuando no queremos que se asignen al modelo, por ahora lo dejeramos vacios

	protected $guarded =[


	];



	
}
