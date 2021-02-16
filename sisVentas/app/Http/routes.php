<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//cuando el usuario nos indique la ruta especifica por url vamos a retornar a auth/login', para mostrar el formulario de acceso al sistema

Route::get('/', function () {
    return view('auth/login');
});



Route::resource('avisos/aviso','AvisoController');


Route::resource('almacen/categoria','CategoriaController');

//Este controlador es para consultar un articulo en especifico, para el rol vendedor, sin darle acceso a mas nada : ojo esra ruta consulta, me esta chocando con la ruta consulta del buscador que no se donde la tienen definida

Route::get('consulta','ConsultaController@index');




// Agregraemos una ruta(esta ruta ira ligada a un controlador) del tipo resourse para crear un grupo de rutas de recursos con las peticiones, index,carete,update, add, destroid, etc, que son las mas usada en laravel; las carpetas almacen y articulos estaras dentro d ela carpeta vista, el controlador asociado será : "ArticuloController"



Route::resource('almacen/articulo','ArticuloController');

Route::resource('articulos_agotados','ArticulosAgotadosController');



//esta es otra forma de definir las rutas
/*
Route::get('almacen/articulo','ArticuloController@index');
Route::get('almacen/articulo/edit/{id}','ArticuloController@edit');
Route::delete('almacen/articulo/{id}','ArticuloController@destroy');
Route::get('almacen/articulo/create','ArticuloController@create');
Route::post('almacen/articulo','ArticuloController@store');

*/ 

//Ruta para gestionar Clientes

Route::resource('ventas/cliente','ClienteController');

//Ruta para gestionar proveedores

Route::resource('compras/proveedor','ProveedorController');


//ruta para gestionar ingresos de productos

Route::resource('compras/ingreso','IngresoController');

//ruta para getsionar registro de ventas

Route::resource('ventas/venta','VentaController');


//ruta para getsionar registro de devoluciones

Route::resource('ventas/devolucion','DevolucionController');


//Estas dos rutas me permiten gestionar el acceso a nuestro sistema

//Ruta para gestionar Vendedores
 
Route::resource('tiendas/vendedor','VendedorController');

//Rutas para gestionar comisiones de vendedores

Route::resource('comisiones','ComisionController');

Route::get('calcular_comisiones','ComisionController@index');


//ruta para getsionar tiendas

Route::resource('talla/tallas','TallaController');

//ruta para getsionar tallas

Route::resource('tiendas/tienda','TiendaController');

/////////////////////////////////GRAFICAS VENTAS-COMPRAS-ARTICULOS MAS VENDIDOS \\\\\\\\\\\\\\\\\\\\\

//rutas para graficas ventas, y articulos tendencias.



//esta ruta la ultilizó para entrar a la interfaz principal de las graficas al selecionar el boton tendencias en el menú, y seleccionar ver las graficas con valores referente a la fecha actual

	
Route::get('listado_graficas','GraficasController@index');

//Esta ruta la ultilizó para desde la interfaz de la grafica(utilizando dos select) enviar los parametros anio y mes desde el js donde esta el codigo de la grafica al controlador especificamente a la funcion registro_mes y luego recibir en el js de la grafica ese controlador una serie de resultados por medio de json, y asi renderizar(dibujar) la graficar en la interfaz en el div donde es llamada
Route::get('grafica_registros/{anio}/{mes}','GraficasController@registros_mes');
Route::get('grafica_compras/{anio}/{mes}','GraficasController@compra_mes');
Route::get('grafica_publicaciones','GraficasController@total_publicaciones');

//Esta ruta es para la grafica de la libreira chart

Route::get('grafica_muestra','GraficasController_chart@index');

Route::get('grafica_mensual','GraficamensualController@index');

Route::resource('neo','GraficamensualController');

Route::get('neo2','GraficamensualController@store');

//Utilzó este controlador para enviar el año de la grafica anual desde el formulario al controlador
//Route::get('rafica_neo','@create');

//Route::resource('grafica_neo','graficamensualController');

//Esta ruta Route::auth(); nos permite gestionar nel acceso a nuestro proyecto

Route::auth();

Route::get('/home', 'HomeController@index');

//ruta para gestsionar los usuarios

Route::resource('seguridad/usuario','UsuarioController');

/////////////////rutas directas para el panel de control\\\\\\\\\\\\\\\\

Route::get('facturar','VentaController@create');
Route::get('compras','IngresoController@create');
Route::get('cliente','ClienteController@create');
Route::get('informe','ClienteController@create');


//Ruta para cambiar el estatus de la venta

Route::get('pagada','VentaController@estatus');



//Ruta para gestionar proveedores

//Ruta para pribar graficas de la libreria chart

Route::get('grafica_muestra','GraficasController_chart@index');

//Ruta para informa al ususario que el vendedor no posee comisiones acumuladas

Route::get('mensaje','MensajeController@index');



//ruta para gestsionar configuracion

Route::resource('configuracion/parametros','ParametrosController');

//Ruta para imprimir facturas

Route::get('pfd/factura/{id}','FacturaController@show');


//Ruta para imprimir la Nota de Credito (Constancia de devolución de articulos)

Route::get('pfd/notacredito/{iddevolucion}','NotaCreditoController@show');





//Esta ruta es para evitar que se genere un error si un usuario coloca un url distinto, una vez abierto el sistema, y en ese caso le digo que nos redireccione a homeController (y vamos a enviar el index como parametro)el cual es una vista que no tiene contenido aun, y ahí redireecionamos tamnbien a la vista home.blade donde pudiera mostrar las estadisticas de ventas u simplemente redireccionanos a ventas/venta

Route::resource('/{slug}','HomeController@index');
//Route::auth();

//Route::get('/home', 'HomeController@index');
