@extends ('layouts.admin')
@section ('contenido')


<section class="content-header">
     
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Panel de control
        <li><a href="{{url('seguridad/usuario')}}"><i class="fa fa-users"></i> Gestionar Usuarios</a></li>
        <li><a href="#"> Editar Usuario
        
      </ol>
    </section>


	<div class="row">
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				
				<h3>Editar Usuario {{$usuario->name}}</h3>
				
						@if(count($errors)>0)

						<div class="alert alert-danger">
							<ul>
					

									@foreach ($errors->all() as $error)
					
											<li>{{$error}}</li>

									@endforeach

							</ul>

						</div>
						@endif



						{!! Form::model($usuario,['method'=>'PATCH','route'=>['seguridad.usuario.update',$usuario->id]])!!}
						
							{{Form::token()}}

									 <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$usuario->name}}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail neo</label>

                            <div class="col-md-6">
                                <input disabled id="email" type="email" class="form-control" name="email" value="{{$usuario->email}}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                           <div class="form-group{{ $errors->has('tipoUsuario') ? ' has-error' : '' }}">
                            
      <div style="float: left; width: 36%;"> <label for="tipoUsuario" class="col-md-4 control-label">Rol</label></div>                   
        <div style="float: left; width: 64%;">
                                <select style="width: 69%;" name="tipoUsuario" class="form-control">
                                        
                                     
                                    
                            <option <?php if($usuario->tipoUsuario=="1"){?> selected value="1" <?php } ?>  >Administrador  </option>
                                        
                                        
                                    
                            <option <?php if($usuario->tipoUsuario=="2"){?> selected <?php }?> value="2"  >Vendedor</option>

                                      
                                    

                            
                                </select>
        </div>


                                @if ($errors->has('tipoUsuario'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tipoUsuario') }}</strong>
                                    </span>
                                @endif
                            </div>
     




                        </div>


                            <div class="row">
        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

								<div class="form-group"></div>
								<button class="btn btn-primary" type="submit">Guardar</button>
								<button class="btn btn-danger" type="reset">Cancelar</button>
								
                        </div>
                       </div> 

						{!!Form::close()!!}
		</div>
	</div>

@endsection