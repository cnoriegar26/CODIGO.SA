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
				<a class=" nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Información</a>
		  	</li>	
		</ul>
		
		</div>
		
		<div class="row">
		<div class="col-md-12 tab-content contenido_cuerpo" id="pills-tabContent">
	  		
	  		<!--informacion-->
	  		<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
				
			<div class="row titulo_tab_control">
				<div class="col-md-12" >
					Datos Empresariales
				</div>
				
			</div>
			
			<div class="row" style="padding-top: 25px">
			
				<div class="col-md-8 offset-1" >
				
				<form action="../../controlador/controlador_empresa.php" id="registrar_empresa" method="post">
				
				<input type="hidden" id="operador" name="operador">
				<input type="hidden" id="nit2" name="nit2">
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4"></div>
							<div class="col-md-8" align="center">
								<span class="fa fa-building fa-3x"></span><br>Datos empresa
								<br>
								<div id="alert"></div>
							</div>
							
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Nit</label></div>
							<div class="col-md-8">
								<input type="text" class="input_text validarCampo" id="nit" name="nit" pattern="[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ-\s]{2,50}" required>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Nombre</label></div>
							<div class="col-md-8">
								<input type="text" class="input_text validarCampo" id="nombre" name="nombre" pattern="[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ-#\s]{2,50}" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Misión</label></div>
							<div class="col-md-8">
								<textarea class="input_textarea" id="mision" name="mision"></textarea>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Visión</label></div>
							<div class="col-md-8">
								<textarea class="input_textarea" id="vision" name="vision"></textarea>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Dirección</label></div>
							<div class="col-md-8">
								<input type="text" class="input_text " id="direccion" name="direccion" >
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Teléfono</label></div>
							<div class="col-md-8">
								<input type="text" class="input_text validarCampo" id="telefono" name="telefono" pattern="\S{6,9}[0-9]" title = 'Solo numeros, 10 digitos' required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Correo</label></div>
							<div class="col-md-8">
								<input type="email" class="input_text validarCampo" id="correo" name="correo">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-12" align="right">
							<button type="submit" class="btn boton_form validarFormulario" id="btn_registrar"><span class="fa fa-save fa-2x"></span><br>Guardar</button>
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

<script type="text/javascript">
		
	$("#imagen").fileinput({
			showUpload: false
		});
	$(document).ready(function(){
		traer_empresa();
	});
	
	function traer_empresa(){
		$.ajax({
			url:'../../controlador/controlador_empresa.php',
			dataType: "json",
			type:"POST",
			data:{operador:'traer_empresa'},
			success:function(respuesta){
				//alert(respuesta);
				
				if (respuesta['tipo']=='true'){
					$("#nit").val(respuesta['nit']);
					$("#nombre").val(respuesta['nombre']);
					$("#correo").val(respuesta['correo']);
					$("#direccion").val(respuesta['direccion']);
					$("#telefono").val(respuesta['telefono']);
					$("#mision").val(respuesta['mision']);
					$("#vision").val(respuesta['vision']);
					$("#operador").val('actualizar_empresa');
					$("#nit2").val(respuesta['nit']);
					$("#nit").attr('disabled','true');
				}else{
				$("#operador").val('registrar_empresa');
				}
			},
			error:function(rsultado){
				alert(rsultado.status);
			}
			
		});
	}
	
	$("#registrar_empresa").on('submit',function(event){
		event.preventDefault();
		$("#btn_registrar").attr('disabled','true');	
			$.ajax({
					url:'../../controlador/controlador_empresa.php',
					dataType: "json",
					type:"POST",
					data:$("#registrar_empresa").serialize(),
					success:function(respuesta){
						//alert(respuesta);
						if (respuesta['tipo']=='true'){
							$("#alert").html(respuesta['alerta']);
							clearAlert();
						}else{
							$("#alert").html(respuesta['alerta']);
						}
						$("#btn_registrar").removeAttr('disabled');

					},
					error:function(rsultado){
						alert(rsultado.status);
					}
			});
	});
	
	
</script>

</html>