<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SisVentasNeo 1.0</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
     <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">

    <!-- Esta librería es para utilizar el calendario de boostrad que a su ve usa una funcion jqyery que esta al final de este documento que llama las funciones de jquery en cada div del formulario, pero debe colocarse el nombre del div que va a utilizar estas funciones  -->

    <!-- daterange picker -->
  
   <link rel="stylesheet" href="{{asset('css/bootstrap-daterangepicker/daterangepicker.css')}}">

  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>SisVentasNeo 1.0</b>V</span>
          <!-- logo for regular state and mobile devices -->


          <span class="logo-lg"><b>SisVentasNeo 1.0</b></span>
        </a>


        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 <span 
                 
                  
                  <small class="hidden-xs"><?php if(Auth::user()->tipoUsuario=='1'){echo "  Administrador :";} else echo "Vendedor:"; ?>
                  
                  <img src="{{asset('img/cerrar_sesion.ico')}}" class="user-image" class="user-image" alt="User Image">
                  </small>
                  </span>

                  <span class="hidden-xs">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    
                    <p>
                      Sistema de ventas e inventario
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="{{url('/logout')}}" class="btn btn-default btn-flat">Cerrar sesión</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            

          <?php if(Auth::user()->tipoUsuario=='1')
          {
          ?>


          <li class="active treeview">
          <a href="#">
          <i class="fa fa-dashboard"></i>
            <span>Escritorio</span>
           
            <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            
            <li><a href="{{url('/home')}}"><i class="fa fa-circle-o"></i> Panel de control</a></li>
          </ul>
        </li>

        <?php
          }
        ?>

          <?php if(Auth::user()->tipoUsuario=='2')
          {
          ?>

          
            <li class="treeview">
              <a href="#">
                <i class="fa fa-search"></i>
                <span>Consultar</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('consultar')}}"><i class="fa fa-circle-o"></i>Articulo</a></li>
                
              </ul>
            </li>
          

          <?php
          }
          ?>

           <?php if(Auth::user()->tipoUsuario=='1')
          {
          ?>



            <li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Ventas</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('ventas/venta')}}"><i class="fa fa-circle-o"></i> Gestionar</a></li>
                <li><a href="{{url('ventas/cliente')}}"><i class="fa fa-circle-o"></i> Clientes</a></li>
                <li><a href="{{url('ventas/devolucion')}}"><i class="fa fa-circle-o"></i> Devoluciones</a></li>                
              </ul>
            </li>


             <li class="treeview">
              <a href="#">
                <i class="fa fa-truck"></i>
                <span>Compras</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('compras/ingreso')}}"><i class="fa fa-circle-o"></i> Ingresos</a></li>
                <li><a href="{{url('compras/proveedor')}}"><i class="fa fa-circle-o"></i> Proveedores</a></li>
              </ul>
            </li>
            

              <li class="treeview">               <a href="#">
<i class="fa fa-pie-chart"></i> <span>Graficas</span>                 <i
class="fa fa-angle-left pull-right"></i>               </a>

                <ul class="treeview-menu">
                
                <li><a href="{{url('listado_graficas')}}"><i class="fa fa-circle-o"></i> Tendencias Diarias</a></li>
                
              </ul>


             <ul class="treeview-menu">
                
                <li><a href="{{url('grafica_mensual')}}"><i class="fa fa-circle-o"></i> Tendencias Mensuales</a></li>
                
              </ul>    



               <ul class="treeview-menu">
                
                <li><a href="{{url('grafica_muestra')}}"><i class="fa fa-circle-o"></i> Respaldo </a></li>
                
              </ul>
        


               <ul class="treeview-menu">
                
                <li><a href="{{url('pfd/factura')}}"><i class="fa fa-circle-o"></i> Reporte Factura </a></li>
                
              </ul>

            </li>

            <li class="treeview">
              <a >
                <i class="fa fa-laptop"></i>
                <span>Almacén</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                
                <li><a href="{{url('almacen/articulo')}}"><i class="fa fa-circle-o"></i> Artículos</a></li>
                
                <li><a href="{{url('articulos_agotados')}}"><i class="fa fa-circle-o"></i> Artículos Agotados</a></li>
                
                <li><a href="{{url('talla/tallas')}}"><i class="fa fa-circle-o"></i> Tallas</a></li>x
              </ul>
            </li>
            
           
            <li class="treeview">
              <a>
                <i class="fa fa-institution"></i>
                <span>Tiendas</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('tiendas/tienda')}}"><i class="fa fa-circle-o"></i> Tiendas</a></li>
                <li><a href="{{url('almacen/categoria')}}"><i class="fa fa-circle-o"></i> Departamentos</a></li>
                <li><a href="{{url('tiendas/vendedor')}}"><i class="fa fa-circle-o"></i> Vendedores</a></li>

                 <li><a href="{{url('comisiones')}}"><i class="fa fa-circle-o"></i> Comisiones de Venta</a></li>
              
              </ul>
            </li>
                       
            <li class="treeview">
              <a>
                <i class="fa fa-users"></i> <span>Usuarios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('seguridad/usuario')}}"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                
              </ul>
            </li>

             <li class="treeview">
              <a>
                <i class="fa fa-gear"></i> <span>Configuración</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('configuracion/parametros')}}"><i class="fa fa-circle-o"></i> Parametros</a></li>
                
              </ul>
            </li>
           
            <li>
              <a>
                <i class="fa fa-book"></i> <span>Documentación...</span>
                
              </a>
            </li>

         <?php
          }
          ?>    
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>


       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Sistema de Ventas</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                              <!--Contenido-->
                              @yield('contenido')
                              <!--Fin Contenido-->
                           </div>
                        </div>
                        
                      </div>
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2020-2030 <a href="#">Desarrollador Neomar Medina</a>.</strong> Todos los derechos reservados
      </footer>

      
    <!-- jQuery 2.1.4  que utilizo para hacer las funciones jQuery de tablas dinamicas -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <!-- jQuery que utilizo para las graficas -->
    <script src="{{asset('js/jquery.js')}}"></script>
     <!-- jQuery para graficas Chart.JS -->
    <script src="{{asset('js/Chart.min.js')}}"></script>

   

    @stack('scripts')
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
  
    <!-- java scripts para graficas Highcharts -->
    <script src="{{asset('js/sistemalaravel.js')}}"></script>
    <script src="{{asset('js/highcharts.js')}}"></script>
    <script src="{{asset('js/graficas.js')}}"></script>
    



    <!-- javascript del sistema laravel >
   <script src="js/sistemalaravel.js"></script>
  <script src="js/highcharts.js"></script>
  <script src="js/graficas.js"></script-->


  </body>






</html>
