<html >
<head>
<?php include("head.php"); ?>
<link rel="stylesheet" href="../css/general_index.css">
</head>
<body>

<section>
	<?php include("barra.php"); ?>
</section>
<section>
	<?php include("navegador_3.php");?>
</section>

<section>
	<div class="container contenedor" >
		<div class="row">
			<div class="col-md-6 offset-md-3"  >
				<div class="col-md-12 titulo_registro">
					Perfil
				</div>
				<div class="col-md-12">
					<p>Modificar datos de perfil</p>
				</div>
				<div id="alert"></div>
				<form action="../controlador/controlador_usuarios.php" method="post" id="actualizar_perfil">
				<input type="hidden" id="operador2" name="operador" value="actualizar_usua">
				<input type="hidden" id="rol_pers" name="rol_pers" value="2">
				<input type="hidden" id="documento2_pers" name="documento2_pers">
				
				<div class="col-md-12">
					<div class="form-group">
						<div class="row" >
							<div class="col-md-6"  align="right">
								<label >Documento</label></div>
							<div class="col-md-6" style="padding: 0">
								<input type="text" class="input_text" id="documento_pers" name="documento_pers" disabled>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-6"  align="right">
								<label >Nombres</label></div>
							<div class="col-md-6" style="padding: 0">
								<input type="text" class="input_text validarCampo" id="nombre_pers" name="nombre_pers" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{2,50}" title = 'Solo letras, de 2 a 50 caracteres' required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-6"  align="right">
								<label >Direccion</label></div>
							<div class="col-md-6" style="padding: 0">
								<input type="text" class="input_text validarCampo" id="direccion_pers" name="direccion_pers">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-6"  align="right">
								<label >Teléfono</label></div>
							<div class="col-md-6" style="padding: 0">
								<input type="text" class="input_text validarCampo" id="telefono_pers" name="telefono_pers" pattern="\S{6,9}[0-9]" title = 'Solo numeros, 10 digitos'>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-6"  align="right">
								<label >Correo</label></div>
							<div class="col-md-6" style="padding: 0">
								<input type="email" class="input_text validarCampo" id="correo_pers" name="correo_pers" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-6"  align="right">
								<label >Contraseña</label></div>
							<div class="col-md-6" style="padding: 0">
								<input type="password" class="input_text validarCampo" id="contrasena_pers" name="contrasena_pers">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-12" style="padding: 0">
								<button type="submit" class="boton_iniciar validarFormulario" id="btn_actualizar">Cambiar</button>
							</div>
						</div>
					</div>
					
				</div>
				</form>
			</div>
			
		</div>
	</div>
</section>
	
<section>
	<?php include("footer.php"); ?>
</section>

</body>

<?php include("pie.php"); ?> 
<script>
	
	$(document).ready(function(){
		traer_usua(<?php echo($_SESSION['documento']); ?>);
	});
	
	function traer_usua(id){
		$.ajax({
			url:'../controlador/controlador_usuarios.php',
			dataType: "json",
			type:"POST",
			data:{operador:'traer_usua',documento:id},
			success:function(respuesta){
				//alert(respuesta);
				
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
			url:'../controlador/controlador_usuarios.php',
			dataType: "json",
			type:"POST",
			data:$("#actualizar_perfil").serialize(),
			success:function(respuesta){
				//$("#alert").html(respuesta);
				if (respuesta['tipo']=='true'){
					$("#alert").html(respuesta['alerta']);
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