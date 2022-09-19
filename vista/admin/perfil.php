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
				<a class=" nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Perfil</a>
		  	</li>	
		</ul>
		
		</div>
		
		<div class="row">
		<div class="col-md-12 tab-content contenido_cuerpo" id="pills-tabContent">
	  		
	  		<!--listar usuario-->
	  		<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
		  	
		  	<div class="row titulo_tab_control">
				<div class="col-md-12" >
					Datos del usuario
				</div>
			</div>
			
			<div class="row" style="padding-top: 25px">
				<div class="col-md-8 offset-1" >
				<form action="../../controlador/controlador_usuarios.php" method="post" id="actualizar_perfil">
					<input type="hidden" id="operador" name="operador" value="actualizar_usua">
					<input type="hidden" id="documento2_pers" name="documento2_pers">
					<input type="hidden" id="rol_pers" name="rol_pers"> 
				
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4"></div>
							<div class="col-md-8" align="center">
								<span class="fa fa-user-plus fa-3x"></span>
							</div>
						</div>
					</div>
					<div id="alert" class="col-md-8 offset-4" style="margin-top: 10px"></div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Documento</label></div>
							<div class="col-md-8">
								<input type="text" class="input_text" id="documento_pers" name="documento_pers" disabled>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Nombre</label></div>
							<div class="col-md-8">
								<input type="text" class="input_text validarCampo" id="nombre_pers" name="nombre_pers" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{2,50}" title = 'Solo letras, de 2 a 50 caracteres' required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Dirección</label></div>
							<div class="col-md-8">
								<input type="text" class="input_text validarCampo" id="direccion_pers" name="direccion_pers" >
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Teléfono</label></div>
							<div class="col-md-8">
								<input type="text" class="input_text validarCampo" id="telefono_pers" name="telefono_pers" pattern="\S{6,9}[0-9]" title = 'Solo numeros, 10 digitos'>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Correo</label></div>
							<div class="col-md-8">
								<input type="email" class="input_text validarCampo" id="correo_pers" name="correo_pers" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Contraseña</label></div>
							<div class="col-md-8">
								<input type="password" class="input_text validarCampo" id="contrasena_pers" name="contrasena_pers" >
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
		
</div>

</div>
	
</section>
</body>

<?php include("pie.php"); ?>
<script>
	
	$(document).ready(function(){
		traer_usua(<?php echo($_SESSION['documento']); ?>);
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
				$("#rol_pers").val(<?php echo($_SESSION['rol']); ?>);
				$("#documento2_pers").val(respuesta['documento']);
				$("#documento_pers").val(respuesta['documento']);
				$("#nombre_pers").val(respuesta['nombre']);
				$("#correo_pers").val(respuesta['correo']);
				$("#direccion_pers").val(respuesta['direccion']);
				$("#telefono_pers").val(respuesta['telefono']);
				$("#contrasena_pers").val(respuesta['contrasena']);
				//$("#rol_pers option[value ="+respuesta['rol']+"]").attr('selected','true');
				$("#documento2_pers").val(respuesta['documento']);
				
			},
			error:function(rsultado){
				alert(rsultado.status);
			}
			
		});
	}
	
	$("#actualizar_perfil").on('submit',function(event){
		
		event.preventDefault();
		$("#btn_actualizar").attr('disabled','true');	
		$.ajax({
			url:'../../controlador/controlador_usuarios.php',
			dataType: "json",
			type:"POST",
			data:$("#actualizar_perfil").serialize(),
			success:function(respuesta){
				//$("#alert").html(respuesta);
				if (respuesta['tipo']=='true'){
					$("#alert").html(respuesta['alerta']);
					clearAlert();
				}else{
					$("#alert").html(respuesta['alerta']);
				}
				$("#btn_actualizar").removeAttr('disabled');
				traer_usua(<?php echo($_SESSION['documento']); ?>);
			},
			error:function(rsultado){
				alert(rsultado.status);
			}
			
		});
		
		
	});
	
</script>
</html>