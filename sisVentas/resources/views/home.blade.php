<?php 
//ventas/venta es la ruta que defino el el archivo route
if(Auth::user()->tipoUsuario=='1'){

?>

<!! con la etiqueta meta estoy redireccionando al modulo de ventas  !!>
<!--meta http-equiv="refresh" content="0; ventas/venta" /-->

@extends ('layouts.admin')
@section ('contenido')

<!-- ............Modulo de Ventas.....................-->

<!-- Content Wrapper. Contains page content -->
  <div class="row">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Modulos del Negocio
        <small>Panel de Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Panel de Control</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3></h3>



              <i class="fa fa-shopping-cart"><p>Facturar Articulo </p></i>
              


            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{url('facturar')}}" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><sup style="font-size: 20px"></sup></h3>



              <i class="fa fa-truck"><p>Registrar Compra </p></i>
            
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{url('compras')}}" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3></h3>

              <i class="fa fa-pie-chart"><p>Tendencias de Ventas</p></i>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{url('listado_graficas')}}" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3></h3>

                <i class="fa fa-cube"><p>Articulos Agotados</p></i>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{url('articulos_agotados')}}" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

<!-- ............Modulos de Configuración.....................-->


<!-- Content Wrapper. Contains page content -->
  <div class="row">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Modulos de Configuración
        <small></small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3></h3>



              <i class="fa fa-cube"><p>Gestionar Articulos </p></i>
              


            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{url('almacen/articulo')}}" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>



        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><sup style="font-size: 20px"></sup></h3>



              <i class="fa fa-sort-numeric-desc"><p>Gestionar Tallas </p></i>
            
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{url('talla/tallas')}}" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3></h3>

              <i class="fa fa-institution"><p>Gestionar Tiendas</p></i>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{url('tiendas/tienda')}}" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3></h3>

                <i class="fa fa-user-md"><p>Gestionar Vendedores</p></i>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{url('tiendas/vendedor')}}" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>












<!-- ............Modulos de configuración bloque 2.....................-->

<!-- Content Wrapper. Contains page content -->
  <div class="row">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Modulos de Accesibilidad y Roles
        
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3></h3>



              <i class="fa fa-users"><p>Gestionar Usuarios </p></i>
              


            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{url('seguridad/usuario')}}" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><sup style="font-size: 20px"></sup></h3>



              <i class="fa fa-hand-o-up"><p>Guia de Navegavión </p></i>
            
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{url('compras')}}" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        


        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3></h3>

              <i class="fa fa-desktop"><p>Cuadro de Mando Integral</p></i>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{url('grafica_mensual')}}" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

      
        

 


@endsection





<?php

}


if(Auth::user()->tipoUsuario=='2'){
//consulta es la ruta que defino el el archivo route
?>

<!! con la etiqueta meta estoy redireccionando al modulo de ventas  !!>
<meta http-equiv="refresh" content="0; consulta">


<?php

}

?>
