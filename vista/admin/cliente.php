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
				<a class="nav-link " id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Nuevo Cliente</a>
			</li>	
		</ul>
		
		</div>
		
		<div class="row">
		<div class="col-md-12 tab-content contenido_cuerpo" id="pills-tabContent">
	  		
	  		<!--listar cliente-->
	  		<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
		  
		  	<div class="row" style="padding-top: 15px">
				<div class="col-md-3" align="right">
				<h6 style=" padding-top: 8px">Búsqueda</h6>
				</div>

				<div class="col-md-5">
					<div class="input-group mb-3">
						<input type="text" class="form-control buscador" id="busqueda" placeholder="Identificación o nombre" aria-label="Recipient's username" aria-describedby="basic-addon2" oninput="cargarTabla(1)">
						<div class="input-group-append">
						<button class="input-group-text buscador"><span class="fa fa-search"></span></button>
					  </div>
					</div>
				</div>

				<div class="col-md-4" align="left">
					<a type="buttom" class="btn boton_titulo" onClick="crear_pdf()"> Descargar <span class="fa fa-file-pdf"></span></a>
				</div>
			</div>
			
			<div class="table-responsive table-hover" style="padding:40px" id="tabla_cliente">
				
					</div>
		 	</div>
		 	
		 	<!--crear cliente-->
		  	<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
			
			<div class="row titulo_tab_control">
				<div class="col-md-12" >
					Crear Cliente
				</div>
			</div>
			<br>
			<div id="alerta_clie"></div>
			<br>
			<div class="row" style="padding-top: 25px">
			
				<div class="col-md-8 offset-1" >
				<form action="../../controlador/controlador_clientes.php" method="post" id="registrar_cliente">	
				<input type="hidden" value="registrar_clie" id="operador" name="operador">
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4"></div>
							<div class="col-md-8" align="center">
								<span class="fa fa-user-plus fa-3x"></span>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Documento</label></div>
							<div class="col-md-8">
								<input type="text" class="input_text validarCampo" id="documento" name="documento" pattern="\S{7,11}[0-9]" title = 'Solo Numeros, de 7 a 11 digitos' required>
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
								<input type="text" class="input_text" id="direccion" name="direccion" >
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

<!--modal actualizar cliente-->
<div class="modal fade letra_modal " id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
   <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header titulo_modal">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Cliente</h5>
        <button type="button" class="close cerrar_modal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      		<div id="alerta_modal"></div>
			<br>
			<form action="../../controlador/controlador_clientes.php" method="post" id="actualizar_cliente">
			<input type="hidden" value="actualizar_clie" id="operador" name="operador">
			<input type="hidden" value="" id="documento2" name="documento2">
			<div class="row " style="padding-top: 25px">
				<div class="col-md-12" >
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
								<input type="text" class="input_text" id="direccion_pers" name="direccion_pers" >
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
								<input type="email" class="input_text validarCampo" id="correo_pers" name="correo_pers" >
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
				</div>
			</div>
     </form>
      </div>
    </div>
	</div>
</div>
	<div id="prueva"></div>
</section>
</body>

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
				 url:'../../controlador/controlador_clientes.php?pagina='+page+'&busqueda='+busqueda+'&operador=consultar_clie',
				 beforeSend: function(objeto){
			  	},
				success:function(data){
					$("#tabla_cliente").html(data).fadeIn('slow');
				}
			})
	}
	
	$("#registrar_cliente").on('submit',function(event){
		event.preventDefault();
		var data = $("#registrar_cliente").serialize();
		var action = $("#registrar_cliente").attr('action');
		$("#btn_registrar").attr("disabled","true");
		$.ajax({
			url:action,
			data:data,
			type:'POST',
			dataType:'json',
			success:function(respuesta){
					
				if (respuesta['tipo']=='true'){
					$("#alerta_clie").html(respuesta['alerta']);
					$("#registrar_cliente")[0].reset();
					clearAlert();
					
				}else{
					$("#alerta_clie").html(respuesta['alerta']);
				}
				$("#btn_registrar").removeAttr("disabled");
			},
			error: function(respuesta){
				alert(respuesta.status);
			}
			
			
		});
	});
	function traer_clie(id){
		$.ajax({
			url:'../../controlador/controlador_clientes.php',
			dataType: "json",
			type:"POST",
			data:{operador:'traer_clie',documento:id},
			success:function(respuesta){
				$("#Modal").modal('show');
				
				$("#documento_pers").val(respuesta['documento']);
				$("#nombre_pers").val(respuesta['nombre']);
				$("#correo_pers").val(respuesta['correo']);
				$("#direccion_pers").val(respuesta['direccion']);
				$("#telefono_pers").val(respuesta['telefono']);
				$("#documento2").val(respuesta['documento']);
				
			},
			error:function(rsultado){
				alert(rsultado.status);
			}
			
		});
	}
	$("#actualizar_cliente").on('submit',function(event){
		
		event.preventDefault();
		$("#btn_actualizar").attr('disabled','true');	
		$.ajax({
			url:'../../controlador/controlador_clientes.php',
			dataType: "json",
			type:"POST",
			data:$("#actualizar_cliente").serialize(),
			success:function(respuesta){
				
				if (respuesta['tipo']=='true'){
					$("#alerta_modal").html(respuesta['alerta']);
					clearAlert();
				}else{
					$("#alerta_modal").html(respuesta['alerta']);
				}
				$("#btn_actualizar").removeAttr('disabled');
				cargarTabla(1);
			},
			error:function(rsultado){
				alert(rsultado.status);
			}
			
		});
		
		
	});
	function crear_pdf(){
		
		 var html = $("#busqueda").val();
		 $.ajax({
			 url:'../../controlador/controlador_clientes.php',
			 data:{operador:'pdf_comp',busqueda:html},
			 type:'post',
			 success:function(respuesta){
				// $("#prueva").html(respuesta);
				 window.location.href=respuesta;
			 },
			 error:function(respuesta){
				// alert(respuesta.status);
			 }
		 });
	 }
	
	
</script>

</html>