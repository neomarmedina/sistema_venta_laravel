
<?php 

if(Auth::user()->tipoUsuario=='2'){

?>

<!! con la etiqueta meta estoy redireccionando al modulo de ventas  !!>
<meta http-equiv="refresh" content="0; /avisos/aviso" />

<?php

}
?>
@extends ('layouts.admin')
@section ('contenido')

<section class="content-header">
     
      <ol class="breadcrumb">         <li><a href="{{url('/home')}}"><i class="fa
fa-dashboard"></i> Panel de control         <li><a href="#"><i class="fa fa-
shopping-cart"></i> Comisiones</a></li>
       
      </ol>
    </section>





<div class="row">
  
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3> Calcular Comisiones
    </div>

</div>


  {!! Form::open(array('url'=>'comisiones','method'=>'POST','autocomplete'=>'off'))!!}
            
        {{Form::token() }}


<div  class="row" >

  <div class="col-lg-12 col-sm-12 col-md-6 col-xs-12">
        
        <div class="form-group">
        

          <label for="nombre">Vendedor</label>
          
          <select name="idvendedor" id="idvendedor" class="form-control selectpicker" data-live-search="true">
            <option selected="" value="" >Seleccione...</option>
            @foreach ($vendedores as $vendedor)

              <option value="{{$vendedor->idvendedor}}">{{$vendedor->nombre}}</option>

            @endforeach

          </select> 

        </div>

    </div>

   






          <div class="col-lg-12 col-sm-12 col-md-6 col-xs-12">

                 <div class="form-group">
  
                      <label for="anio">Año</label>
                      <select class="form-control selectpicker" data-live-search="true" name="anio" id="anio">

                          <option selected="" value="" >Seleccione...</option>                
                          <option value="2019" >2019</option>
                          <option value="2020" >2020</option>
                          <option value="2021" >2021</option>
                          <option value="2022">2022</option>
                          <option value="2023" >2023</option>

                          <option value="2024" >2024</option>
                          <option value="2025" >2025</option>


                          <option value="2026" >2026</option>
                          <option value="2027" >2027</option>
                          <option value="2028">2028</option>
                          <option value="2029" >2029</option>
                          <option value="2030" >2030</option>
                          
                  
                      </select>
                  </div>
         </div>


      <div class="col-lg-12 col-sm-12 col-md-6 col-xs-12">
                 
    

              <div class="form-group">

                            <label>Mes</label>
                            <select class="form-control selectpicker" data-live-search="true" name="mes" id="mes" >
                            
                              <option selected="" value="" >Seleccione...</option>          <option value="1">ENERO</option>
                              <option value="2">FEBRERO</option>
                              <option value="3">MARZO</option>
                              <option value="4">ABRIL</option>
                              <option value="5">MAYO</option>
                              <option value="6">JUNIO</option>
                              <option value="7">JULIO</option>
                              <option value="8">AGOSTO</option>
                              <option value="9">SEPTIEMBRE</option>
                              <option value="10">OCTUBRE</option>
                              <option value="11">NOVIEMBRE</option>
                              <option value="12">DICIEMBRE</option>
                            
                            </select>
              </div>






              <div class="form-group">

                            <label>Quincena</label>
                            <select class="form-control selectpicker" data-live-search="true" name="quincena" id="quincena" >
                            
                              <option selected="" value="" >Seleccione...</option>          <option value="1">1era Quincena del mes</option>
                              <option value="2">2da Quincena del mes</option>
                    
                            
                            </select>
              </div>




      </div>




          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
  

              <div class="form-group">
                
              


                <a href="">
                <button class="btn btn-primary" type="submit">Calcular</button>
                </a>


                <button class="btn btn-danger" type="reset">Cancelar</button>
              </div>
                

          </div>
</div>
  
</div>

{!!Form::close()!!}
@endsection