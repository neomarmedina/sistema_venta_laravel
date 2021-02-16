<?php 

if(Auth::user()->tipoUsuario=='2'){

?>

<!! con la etiqueta meta estoy redireccionando al modulo de ventas  !!>
<meta http-equiv="refresh" content="0; /consulta" />

<?php

}
?>
@extends ('layouts.admin')
@section ('contenido')


<!-- Content Wrapper. Contains page content -->
  <div class="content-header">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        
        <small>Cuadro de Mando Integral</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-desktop"></i> Home</a></li>
        <li><a href="#"><i class="fa fa-pie-chart"></i>Tendencias Mensuales</a></li>
        
      </ol>
    </section>
    
    
    
    
    
    
    
    
     <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Ventas</span>
              <ul class="info-box-number" id='total_venta_diaria'></ul>

              
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-arrow-up"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Inversión</span>
              <ul class="info-box-number" id='total_compra_diaria'></ul>
              
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-dollar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Ganancias</span>
              <ul class="info-box-number" id='ganancia'></ul>
              
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">N° de Clientes</span>
             <ul class="info-box-number" id='clientes'></ul>
              
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
    
    
    
    
    

  <div class="row">

            <div class="col-lg-12 col-sm-12 col-md-6 col-xs-12">
                  
                    <div class="form-group">

                                <label>Año</label>
                        <select onchange="mostrarResultados(this.value);" class="form-control" data-live-search="true" id="anio" name="anio" >
                                  <?php
                                    for($i=2015;$i<=2030;$i++)
                                    {

                                      if($i == 2015)
                                      {

                                        echo '<option value="'.$i.'" select >'.$i.'</option>';  
                                      }
                                      else
                                      {

                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                      } 
                                    } 

                                  ?>

                                </select>
                    </div>
          </div>
  </div>


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <!-- AREA CHART -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Ventas vs Compras (Bsf)</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="areaChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- DONUT CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Productos mas Vendidos</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <canvas id="pieChart" style="height:250px"></canvas>
            
            <!-- Aquie estoy colocando laleyenda de la Gráfica -->
            
            
                      <!-- /.col -->
                <div class="col-md-4">
                  <ul class="chart-legend clearfix" id='legend_area'>
                    
                  </ul>
                </div>
                <!-- /.col -->
      
            
            <!-- Aqui termina la leyenda de las grafica  -->
            
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (LEFT) -->
        <div class="col-md-6">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Ventas vs Compras (Cantidades)</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="lineChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Ventas vs Compras (Cantidades)</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="barChart" style="height:230px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>

  <!-- me traje esta libreria de la plantilla base -->

  <!-- ChartJS -->
 <script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- ChartJS -->
<script src="../../bower_components/chart.js/Chart.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
  <script src="bower_components/chart.js/Chart.js"></script>


  <!-- Este es el jqyery de la grafica -->

<!-- Aqui coloco los totales de los indicadores-->


 <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 100%</span>
                    
                    
                    
                    <ul class="description-header" id='total_inversion_anual'></ul>
            
                    
                    
                    <span class="description-text">TOTAL DE INVERSIÓN</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 100%</span>
                    
                    <ul class="description-header" id='total_venta_anual'></ul>
                    <span class="description-text">TOTAL DE VENTAS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 100%</span>
                    
                    <ul class="description-header" id='ganancia_anual'></ul>
                    <span class="description-text">TOTAL DE GANANCIAS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block">
                    <span class="description-percentage text-red"><i class="fa fa-caret-down" id='cumplimiento_meta'></i>%</span>
                    <ul class="description-header" ></ul>
                    <span class="description-text">CUMPLIMIENTO DE LA META</span>
                  </div>



<!-- aqui terminan los totales de los Indicadores   -->





  <script>


 $(document).ready(mostrarResultados());
  //$(function mostrarResultados(anio) {


  function mostrarResultados (anio) {

    $.ajax({
     
       type:'GET',
        url:'neo2',
        data:{'anio':anio,'condicion':'grafica1'},
        success:function(data){
            
          
         
         var valore = eval(data); 


         var e = valore[0];
         var f = valore[1];
         var m = valore[2];
         var a = valore[3];
         var ma = valore[4];
         var j = valore[5];
         var jl = valore[6];
         var ag = valore[7];
         var s = valore[8];
         var o = valore[9];
         var n = valore[10];
         var d = valore[11];
         var e2 = valore[12];
         var f2 = valore[13];
         var m2 = valore[14];
         var a2 = valore[15];
         var ma2 = valore[16];
         var j2 = valore[17];
         var jl2 = valore[18];
         var ag2 = valore[19];
         var s2 = valore[20];
         var o2 = valore[21];
         var n2 = valore[22];
         var d2 = valore[23];
         var total_inversion_anual = valore[24];//total de compras anual
         var total_venta_anual = valore[25];//total de ventas anual, este valor lo recibo por json del controlador
         var total_venta_diaria = valore[26];//total de ventas diaria(dia actual), este valor lo recibo por json del controlador
         var total_compra_diaria = valore[27];//total de ventas diaria(dia actual), este valor lo recibo por json del controlador
         var clientes = valore[28];//total de ventas diaria(dia actual), este valor lo recibo por json del controlador
         var ganancia = valore[29];//total de ganacias diaria(dia actual), este valor lo recibo por json del controlador
         var ganancia_anual = valore[30];//total de ganacias diaria(dia actual), este valor lo recibo por json del controlador
         var cumplimiento_meta = valore[31];//total de ganacias diaria(dia actual), este valor lo recibo por json del controlador
         
    
    document.getElementById("total_inversion_anual").innerHTML=total_inversion_anual;//Aqui le envío este valor a la celda html con el id=total_inversion_anual
    
    document.getElementById("total_venta_anual").innerHTML=total_venta_anual;//Aqui le envío este valor a la celda html con el id=total_inversion_anual
            
    document.getElementById("total_venta_diaria").innerHTML=total_venta_diaria;//Aqui le envío este valor a la celda html con el id=total_inversion_diaria
    
    
    document.getElementById("total_compra_diaria").innerHTML=total_compra_diaria;//Aqui le envío este valor a la celda html con el id=total_compra_diaria
         

    document.getElementById("clientes").innerHTML=clientes;//Aqui le envío este valor a la celda html con el id=clientes
    
    document.getElementById("ganancia").innerHTML=ganancia;//Aqui le envío este valor a la celda html con el id=ganancia
    
    document.getElementById("ganancia_anual").innerHTML=ganancia_anual;//Aqui le envío este valor a la celda html con el id=ganancia
    
    document.getElementById("cumplimiento_meta").innerHTML=cumplimiento_meta;//Aqui le envío este valor a la celda html con el id=ganancia
    
    
///////////////// aqui explotará///////////////// 





    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------
    //
      //Aquí vamos a crear algunos gráficos utilizando ChartJS
    // Get context with jQuery - using jQuery's .get() method.
    //Obtenga contexto con jQuery - usando el método .get () de jQuery.(traducción)
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
    // This will get the first returned node in the jQuery collection.
    //Esto obtendrá el primer nodo devuelto en la colección jQuery
    var areaChart       = new Chart(areaChartCanvas)

    var areaChartData = {
      labels  : ['Enero', 'Febrero', 'Marzo', 'ABril', 'Mayo', 'Junio', 'Julio','Agosto', 'Septiembre', 'Octubre', 'Nomviembre', 'Diciembre'],
      datasets: [
        {
          label               : 'Electronics',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [clientes, clientes, m, a, ma, j, jl,ag, s, o, n, d]
        },
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [e2, f2, m2, a2, ma2, j2, jl2,ag2, s2, o2, n2, d2]
        }
      ]
    }

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }
    
    areaChart.Line(areaChartData, areaChartOptions)
    
////////////////////////////////Graficas de Lineas/////////////////////////////
    //Create the line chart
    //Crear el gráfico de líneas
    

    





/////////////////////////////finaliza///////////////////





        } 

  
     });
//////////////////////////////////Grafica 2 ////////////////////////////////////

$.ajax({
     
       type:'GET',
        url:'neo2',
        //data:'anio='+anio+'&condicion='+'grafica2',// esta es la forma como funciona con un parametro
        data:{'anio':anio,'condicion':'grafica2'},
        success:function(data){
            
          
         
         var valore = eval(data); 


         var e = valore[0];//enero
         var f = valore[1];
         var m = valore[2];
         var a = valore[3];
         var ma = valore[4];
         var j = valore[5];
         var jl = valore[6];
         var ag = valore[7];
         var s = valore[8];
         var o = valore[9];
         var n = valore[10];
         var d = valore[11];//diciembre
         var e2 = valore[12];//enero2
         var f2 = valore[13];
         var m2 = valore[14];
         var a2 = valore[15];
         var ma2 = valore[16];
         var j2 = valore[17];
         var jl2 = valore[18];
         var ag2 = valore[19];
         var s2 = valore[20];
         var o2 = valore[21];
         var n2 = valore[22];
         var d2 = valore[23];//duciembre2
        
    
         
///////////////// aqui explotará/////////////////


    
////////////////////////////////Graficas de Lineas/////////////////////////////
    //Create the line chart
    //Crear el gráfico de líneas
    

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
    var lineChart                = new Chart(lineChartCanvas)
    
    //esta linea de abajo, hacía que se cargaran los valores de la grafica de area, y lo modifie agregandole la estructura de var lineChartData y todo el poco de atributos para hacerla dinamica, la estructura es la misma de la grafica de area y la de barras
    
    //var lineChartOptions         = areaChartOptions
        var lineChartData = {
      labels  : ['Enero', 'Febrero', 'Marzo', 'ABril', 'Mayo', 'Junio', 'Julio','Agosto', 'Septiembre', 'Octubre', 'Nomviembre', 'Diciembre'],
      datasets: [
        {
          label               : 'Electronics',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [e, f, m, a, ma, j, jl,ag, s, o, n, d]
        },
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [e2, f2, m2, a2, ma2, j2, jl2,ag2, s2, o2, n2, d2]
        }
      ]
    }

    var lineChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }
    
    lineChartOptions.datasetFill = false
    lineChart.Line(lineChartData, lineChartOptions)// esta estructura la modifque agrenagole lineChartData por decira areaChartData, esto para cargar los datos dinamicos y no copiar lo de la grafica de area
    


        } 

  
     });

///////////////////////////////// Gráfica 3 ///////////////////////////////////


$.ajax({
     
       type:'GET',
        url:'neo2',
        //data:'anio='+anio+'&condicion='+'grafica3',
        data:{'anio':anio,'condicion':'grafica3'},
        success:function(data){        
            
          
         
         var valore = eval(data); 


        
         
         

    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
    

//////////////////////////////Gráfica Circular ////////////////////////////


var cadena_elementos = [];
var cadena_legenda="";
tam=valore.length;

    for(var i=0;i<tam;i++){ 
     
        var nroarticulos = valore[i][0];
        var colorgrafico = valore[i][1];
        var marca = valore[i][2];
        
        cadena_elementos.push({
        value: nroarticulos,
        color: colorgrafico,
        highlight: colorgrafico,
        label: marca
        })
    
    cadena_legenda=cadena_legenda+"<li><i class='fa fa-circle-o' style='color:"+colorgrafico+"'></i> "+marca+"</li>";
  
    }
  
    document.getElementById("legend_area").innerHTML=cadena_legenda;
     
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
   
    
    var PieData        = cadena_elementos 
    
        
    var pieOptions     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions)

/////////////////////////////finaliza///////////////////





        } 

  
     });


//////////////////////////////// Gráfica 4 ///////////////////////////////////

$.ajax({
     
       type:'GET',
        url:'neo2',
        //data:'anio='+anio+'&condicion='+'grafica4',
        data:{'anio':anio,'condicion':'grafica2'},
        success:function(data){
            
          
         
         var valore = eval(data); 


         var e = valore[0];
         var f = valore[1];
         var m = valore[2];
         var a = valore[3];
         var ma = valore[4];
         var j = valore[5];
         var jl = valore[6];
         var ag = valore[7];
         var s = valore[8];
         var o = valore[9];
         var n = valore[10];
         var d = valore[11];
         var e2 = valore[12];
         var f2 = valore[13];
         var m2 = valore[14];
         var a2 = valore[15];
         var ma2 = valore[16];
         var j2 = valore[17];
         var jl2 = valore[18];
         var ag2 = valore[19];
         var s2 = valore[20];
         var o2 = valore[21];
         var n2 = valore[22];
         var d2 = valore[23];
         
         

///////////////// aqui explotará/////////////////





    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */


/////////////////////////////Gráfica de Barras  /////////////////////////////
    //-------------
    //- BAR CHART -
    //-------------
    
    
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    // en esa linea de abajo, yo lo ponia a cargar lo valores de la grafica de areaChartData, pero lo modifique y le coloque los datos dinamicos, solo falta que les pasa es unos valores desde el controlador.
    //var barChartData                     = areaChartData
    
    var barChartData = {
      labels  : ['Enero', 'Febrero', 'Marzo', 'ABril', 'Mayo', 'Junio', 'Julio','Agosto', 'Septiembre', 'Octubre', 'Nomviembre', 'Diciembre'],
      datasets: [
        {
          label               : 'Electronics',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [e, f, m, a, ma, j, jl,ag, s, o, n, d]
        },
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [e2, f2, m2, a2, ma2, j2, jl2,ag2, s2, o2, n2, d2]
        }
      ]
    }

    
    barChartData.datasets[1].fillColor   = '#00a65a'
    barChartData.datasets[1].strokeColor = '#00a65a'
    barChartData.datasets[1].pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)


/////////////////////////////finaliza///////////////////





        } 

  
     });



  
  }
</script>


@endsection