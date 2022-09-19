
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
					Regístrate
				</div>
				<div class="col-md-12">
					<p>Bienvenido al palacio hindu, regístrate y únete a nuestra comunidad.</p>
				</div>
				<div id="alerta_usua"></div>
				<form action="../controlador/controlador_usuarios.php" method="post" id="registrar_user">
				<input type="hidden" id="operador2" name="operador" value="registrar_usua">
				<input type="hidden" id="rol" name="rol" value="2">
				
				<div class="col-md-12">
					<div class="form-group">
						<div class="row" >
							<div class="col-md-6"  align="right">
								<label >Documento</label></div>
							<div class="col-md-6" style="padding: 0">
								<input type="text" class="input_text validarCampo" id="documento" pattern="\S{7,11}[0-9]"  name="documento" title = 'Solo Numeros, de 7 a 11 digitos' required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-6"  align="right">
								<label >Nombres</label></div>
							<div class="col-md-6" style="padding: 0">
								<input type="text" class="input_text validarCampo" id="nombre" name="nombre" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{2,50}" title = 'Solo letras, de 2 a 50 caracteres' required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-6"  align="right">
								<label >Direccion</label></div>
							<div class="col-md-6" style="padding: 0">
								<input type="text" class="input_text validarCampo" id="direccion" name="direccion">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-6"  align="right">
								<label >Teléfono</label></div>
							<div class="col-md-6" style="padding: 0">
								<input type="text" class="input_text validarCampo" id="telefono" name="telefono" pattern="\S{6,9}[0-9]" title = 'Solo numeros, 10 digitos'>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-6"  align="right">
								<label >Correo</label></div>
							<div class="col-md-6" style="padding: 0">
								<input type="email" class="input_text validarCampo" id="correo" name="correo" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-6"  align="right">
								<label >Contraseña</label></div>
							<div class="col-md-6" style="padding: 0">
								<input type="password" class="input_text validarCampo" id="contrasena" name="contrasena" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-6"  align="right">
								<label >Confirmar Contraseña</label></div>
							<div class="col-md-6" style="padding: 0">
								<input type="password" class="input_text validarCampo" id="contrasena2" name="contrasena2" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-12" style="padding: 0">
								<button type="submit" class="boton_iniciar validarFormulario" id="registrar">Registrar</button>
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
		var sesion=<?php if(isset($_SESSION['documento'])){echo(1);}else{echo(2);}?>;
		if (sesion==1){
			window.location.href='index.php?menu=index';
		}
	});
	
	$("#registrar_user").on('submit',function(event){
		event.preventDefault();
		$("#registrar").attr('disabled');
		var data = $("#registrar_user").serialize();
		var action = $("#registrar_user").attr('action');
		if($("#contrasena").val()==$("#contrasena2").val()){
			$.ajax({
			url:action,
			data:data,
			type:'POST',
			dataType:'json',
			success:function(respuesta){
				//$("#alerta_usua").html(respuesta);
				if (respuesta['tipo']=='true'){
					$("#alerta_usua").html(respuesta['alerta']);
					$("#registrar_user")[0].reset();
					clearAlert();
				}else{
					$("#alerta_usua").html(respuesta['alerta']);
				}
				$("#registrar").removeAttr("disabled");
			},
			error: function(respuesta){
				alert(respuesta.status);
			}
			
			
		});
		}else{
			$("#alerta_usua").html('<div class="alert alert-danger alert-dismissible fade show" role="alert">¡la contraseña y la confirmacion deben ser iguales!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		}
		
		
	});
	
	</script>

</html>