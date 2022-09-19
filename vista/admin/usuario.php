<html >
<head>
<?php include("head.php"); ?>
</head>
<body>
<section>
	<?php include("navegador1.php"); ?>
</section>
<section class="container-fluid" style="height: 100%">
<div class="row">
	<?php include("navegador2.php"); ?>
		
<div class="col-md-11 cuerpo ">
		<!--emcabezado del cuerpo-->
		
	<div class="col-md-12" style="padding-top: 5px">
		
		<!--encabezado tab-panel-->
		<div class="row">
		<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="margin-top: 5px">
			<li class="nav-item">
				<a class=" nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" onClick="recargar()">Consulta</a>
		  	</li>
		  	<li class="nav-item">
				<a class="nav-link " id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"> Nuevo Usuario</a>
			</li>	
		</ul>
		
		</div>
		
		<div class="row">
		<div class="col-md-12 tab-content contenido_cuerpo" id="pills-tabContent">
	  		
	  		<!--listar usuario-->
	  		<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
		  
		  	<div class="row" style="padding-top: 15px">
				<div class="col-md-3" align="right">
				<h6 style=" padding-top: 8px">Búsqueda</h6>
				</div>

				<div class="col-md-5">
					<div class="input-group mb-3">
						<input type="text" class="form-control buscador" placeholder="Identificación o nombre" aria-label="Recipient's username" aria-describedby="basic-addon2" id="busqueda" oninput="cargarTabla(1)">
						<div class="input-group-append">
						<button class="input-group-text buscador" onClick="cargarTabla(1)"><span class="fa fa-search"></span></button>
					  </div>
					</div>
				</div>
			</div> 
			
			<div class="table-responsive table-hover " style="padding:40px" id="resultado">
						
					</div>
		 	</div>
		 	
		 	<!--crear usuario-->
		  	<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
			
			<div class="row titulo_tab_control">
				<div class="col-md-12" >
					Crear Usuario
				</div>
			</div>
			
			<div class="row" style="padding-top: 25px">
				<br>
				<div id="alerta_usua" class="col-12"></div>
				<br>
				<div class="col-md-8 offset-1" >
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4"></div>
							<div class="col-md-8" align="center">
								<span class="fa fa-user-plus fa-3x"></span>
							</div>
						</div>
					</div>
					<form action="../../controlador/controlador_usuarios.php" method="post" class="" id="registrar_usuario">
					<input type="hidden" id="operador" name="operador" value="registrar_usua">
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Documento</label></div>
							<div class="col-md-8">
								<input type="text" class="input_text validarCampo" id="documento" pattern="\S{7,11}[0-9]"  name="documento" title = 'Solo Numeros, de 7 a 11 digitos' required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Nombre</label></div>
							<div class="col-md-8">
								<input type="text" class="input_text validarCampo" id="nombre" name="nombre" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{2,50}" title = 'Solo letras, de 2 a 50 caracteres' required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Dirección</label></div>
							<div class="col-md-8">
								<input type="text" class="input_text validarCampo" id="direccion" name="direccion" >
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Teléfono</label></div>
							<div class="col-md-8">
								<input type="text" class="input_text validarCampo" id="telefono" name="telefono" pattern="\S{6,9}[0-9]" title = 'Solo numeros, 10 digitos'>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Correo</label></div>
							<div class="col-md-8">
								<input type="email" class="input_text validarCampo" id="correo" name="correo" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Rol</label>
							</div>
							<div class="col-md-8">
								<select class="input_text selected validarCampo" id="rol" name="rol">
  									<option selected value="0">Administrador</option>
  									<option value="1">Trabajador</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Contraseña</label></div>
							<div class="col-md-8">
								<input type="password" class="input_text validarCampo" id="contrasena" name="contrasena" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-12" align="right">
							<button type="submit" class="btn boton_form validarFormulario" id="btn_registrar_usua"><span class="fa fa-save fa-2x"></span><br>Guardar</button>
							</div>
						</div>
					</div>
					</form>
				</div>
			</div>
		  
		  	</div>
		</div>
		</div>	
		
	</div>
		
</div>

</div>

<!--modal actualizar usuario-->
<div class="modal fade letra_modal " id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
   <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header titulo_modal">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Usuario</h5>
        <button type="button" class="close cerrar_modal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			
			<div class="row " style="padding-top: 25px">
				<div class="col-md-12" >
				<div id="alert_modal"></div>
				<form action="../../controlador/controlador_usuarios.php" method="post" id="actualizar_usuario">
					<input type="hidden" id="operador" name="operador" value="actualizar_usua">
					<input type="hidden" id="documento2_pers" name="documento2_pers" value="">
					<div class="form-group">
						<div class="row" >
							<div class="col-md-3" align="right">
								<label >Documento</label></div>
							<div class="col-md-9">
								<input type="text" class="input_text" id="documento_pers" name="documento_pers" disabled >
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-3" align="right">
								<label >Nombre</label></div>
							<div class="col-md-9">
								<input type="text" class="input_text validarCampo" id="nombre_pers" name="nombre_pers" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{2,50}" title = 'Solo letras, de 2 a 50 caracteres' required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-3" align="right">
								<label >Dirección</label></div>
							<div class="col-md-9">
								<input type="text" class="input_text validarCampo" id="direccion_pers" name="direccion_pers" >
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-3" align="right">
								<label >Teléfono</label></div>
							<div class="col-md-9">
								<input type="text" class="input_text validarCampo" id="telefono_pers" name="telefono_pers" pattern="\S{6,9}[0-9]" title = 'Solo numeros, 10 digitos'>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-3" align="right">
								<label >Correo</label></div>
							<div class="col-md-9">
								<input type="email" class="input_text validarCampo" id="correo_pers" name="correo_pers" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-3" align="right">
								<label >Rol</label>
							</div>
							<div class="col-md-9">
								<select class="input_text validarCampo" id="rol_pers" name="rol_pers">
  									<option value="0">Administrador</option>
  									<option value="1">Trabajador</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-3" align="right">
								<label >Contraseña</label></div>
							<div class="col-md-9">
								<input type="password" class="input_text validarCampo" id="contrasena_pers" name="contrasena_pers" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-12" align="right">
							<button type="submit" class="btn boton_form validarFormulario" id="btn_actualizar"><span class="fa fa-save fa-2x"></span><br>Guardar</button>
							</div>
						</div>
					</div>
					</form>
				</div>
			</div>
      </div>
    </div>
	</div>
</div>
	
</section>
<?php include("pie.php"); ?>

<script>
	$(document).ready(function(){
			cargarTabla(1);
		});

		function recargar(){
			$("#busqueda").val("");
			cargarTabla(1);
		}
		
		function cargarTabla(page){
			
			var busqueda= $("#busqueda").val();
			
			$.ajax({
				 url:'../../controlador/controlador_usuarios.php?pagina='+page+'&busqueda='+busqueda+'&operador=consultar_usua',
				 beforeSend: function(objeto){
			  	},
				success:function(data){
					$("#resultado").html(data).fadeIn('slow');
				}
			})
		}
	
	$("#registrar_usuario").on('submit',function(event){
		event.preventDefault();
		var data = $("#registrar_usuario").serialize();
		var action = $("#registrar_usuario").attr('action');
		$("#btn_registrar_usua").attr("disabled","true");
		$.ajax({
			url:action,
			data:data,
			type:'POST',
			dataType:'json',
			success:function(respuesta){
				//$("#alerta_usua").html(respuesta);
				if (respuesta['tipo']=='true'){
					$("#alerta_usua").html(respuesta['alerta']);
					$("#registrar_usuario")[0].reset();
					clearAlert();
					
				}else{
					$("#alerta_usua").html(respuesta['alerta']);
				}
				$("#btn_registrar_usua").removeAttr("disabled");
			},
			error: function(respuesta){
				alert(respuesta.status);
			}
			
			
		});
	});
	
	function traer_usua(id){
		$.ajax({
			url:'../../controlador/controlador_usuarios.php',
			dataType: "json",
			type:"POST",
			data:{operador:'traer_usua',documento:id},
			success:function(respuesta){
				//alert(respuesta);
				$("#Modal").modal('show');
				
				$("#documento_pers").val(respuesta['documento']);
				$("#nombre_pers").val(respuesta['nombre']);
				$("#correo_pers").val(respuesta['correo']);
				$("#direccion_pers").val(respuesta['direccion']);
				$("#telefono_pers").val(respuesta['telefono']);
				$("#contrasena_pers").val(respuesta['contrasena']);
				$("#rol_pers option[value ="+respuesta['rol']+"]").attr('selected','true');
				$("#documento2_pers").val(respuesta['documento']);
				
			},
			error:function(rsultado){
				alert(rsultado.status);
			}
			
		});
	}
	
	$("#actualizar_usuario").on('submit',function(event){
		
		event.preventDefault();
		$("#btn_actualizar").attr('disabled','true');	
		$.ajax({
			url:'../../controlador/controlador_usuarios.php',
			dataType: "json",
			type:"POST",
			data:$("#actualizar_usuario").serialize(),
			success:function(respuesta){
				//alert(respuesta);
				if (respuesta['tipo']=='true'){
					$("#alert_modal").html(respuesta['alerta']);
					clearAlert();
				}else{
					$("#alert_modal").html(respuesta['alerta']);
				}
				$("#btn_actualizar").removeAttr('disabled');
				cargarTabla(1);
			},
			error:function(rsultado){
				alert(rsultado.status);
			}
			
		});
		
		
	});
	
	function estado(id){
		$.ajax({
			url:'../../controlador/controlador_usuarios.php',
			type:"POST",
			data:{operador:'estado_usua',documento:id},
			success:function(respuesta){
				cargarTabla(1);
				
			},
			error:function(rsultado){
				alert(rsultado.status);
			}
			
		});
	}
	$('#Modal').on('hidden.bs.modal', function (e) {
		$("#alerta_modal").html("");
		$("#rol_pers option:selected").each(function () {
               		$(this).removeAttr('selected'); 
               });
		
	})
	
</script>
</body>
</html>