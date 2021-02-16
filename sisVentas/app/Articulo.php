<?php

namespace sisVentas;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
 

	//Definimos la tabla a la que va hacer referencia este modelo

	Protected $table='articulo';

	// Definimos el atributo que va hacer primarykey del modelo

	protected $primaryKey="idarticulo";

	//Laravel nos permite adicional a la tabla dos columnas,Estas columna nos va a permitir saber cuando ha sido creado o modifocado el registro. en este caso la colocamos en false porq no la vamos autilizar.

	public $timestamps=false;

	//Ahora definimos los campos que van a recibir un valor para poder almacenarlos en la base de datos.

	protected $fillable =[

		'idcategoria',
		'idtalla',
		'codigo',
		'nombre',
		'stock',
		'descripcion',
		'marca',
		'modelo',
		'unidad_medida',
		'imagen',
		'estado'

	];


// Este tipo de campo se van a especificar cuando no queremos que se asignen al modelo, por ahora lo dejeramos vacios

	protected $guarded =[


	];

}
