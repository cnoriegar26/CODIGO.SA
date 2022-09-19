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
				<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" onClick="recargar()">Consulta</a>
		  	</li>
		  	<li class="nav-item">
				<a class="nav-link " id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Nuevo Proveedor</a>
			</li>	
		</ul>
		
		</div>
		
		<div class="row">
		<div class="col-md-12 tab-content contenido_cuerpo" id="pills-tabContent">
	  		
	  		<!--listar proveedor-->
	  		<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
		  
		  	<div class="row" style="padding-top: 15px">
				<div class="col-md-3" align="right">
				<h6 style=" padding-top: 8px">Búsqueda</h6>
				</div>

				<div class="col-md-5">
					<div class="input-group mb-3">
						<input type="text" class="form-control buscador" placeholder="Identificación o nombre" aria-label="Recipient's username" aria-describedby="basic-addon2" id="busqueda" oninput="cargarTabla(1)">
						<div class="input-group-append">
						<button class="input-group-text buscador"><span class="fa fa-search"></span></button>
					  </div>
					</div>
				</div>

			</div>
			
			<div class="table-responsive table-hover" style="padding:40px" id="resultado">
					</div>
		 	</div>
		 	
		 	<!--crear proveedor-->
		  	<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
			
			<div class="row titulo_tab_control">
				<div class="col-md-12 " >
					Crear Proveedor
				</div>
			</div>
			
			<div class="row" style="padding-top: 25px">
			<div id="alerta_prov" class="col-12"></div>
				<div class="col-md-8 offset-md-1" >
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4"></div>
							<div class="col-md-8" align="center">
								<span class="fa fa-user-plus fa-3x"></span>
							</div>
						</div>
					</div>
					<form action="../../controlador/controlador_proveedores.php" method="post" id="registrar_proveedor">
					<input type="hidden" name="operador" id="operador2" value="registrar_prov">
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Documento o Nit</label></div>
							<div class="col-md-8">
								<input type="text" class="input_text validarCampo" id="nit" name="nit" pattern="\S{7,11}[0-9]" title = 'Solo Numeros, de 7 a 11 digitos' required>
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
								<input type="text" class="input_text validarCampo" id="direccion" name="direccion" required>
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
								<input type="email" class="input_text validarCampo" id="correo" name="correo" >
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Descripción</label>
							</div>
							<div class="col-md-8">
								<textarea class="input_textarea" id="descripcion" name="descripcion"></textarea>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-12" align="right">
							<button type="submit" class="btn boton_form validarFormulario" id="btn-registrar"><span class="fa fa-save fa-2x"></span><br>Guardar</button>
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

<!--modal actualizar Proveedor-->
<div class="modal fade letra_modal " id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
   <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header titulo_modal">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Proveedor</h5>
        <button type="button" class="close cerrar_modal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			
			<div class="row " style="padding-top: 25px">
				<div class="col-md-12" >
				<div id="alerta_modal"></div>
				<form action="../../controlador/controlador_proveedores.php" method="post" id="actualizar_prov">
				<input type="hidden" name="operador" id="operador" value="actualizar_prov">
				<input type="hidden" name="nit2" id="nit2" value="">
					<div class="form-group">
						<div class="row" >
							<div class="col-md-3" align="right">
								<label >Documento</label></div>
							<div class="col-md-9">
								<input type="text" class="input_text" id="nit_prov" name="nit_prov" disabled >
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-3" align="right">
								<label >Nombre</label></div>
							<div class="col-md-9">
								<input type="text" class="input_text validarCampo" id="nombre_prov" name="nombre_prov" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{2,50}" title = 'Solo letras, de 2 a 50 caracteres' required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-3" align="right">
								<label >Dirección</label></div>
							<div class="col-md-9">
								<input type="text" class="input_text" id="direccion_prov" name="direccion_prov">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-3" align="right">
								<label >Teléfono</label></div>
							<div class="col-md-9">
								<input type="text" class="input_text validarCampo" id="telefono_prov" name="telefono_prov" pattern="\S{6,9}[0-9]" title = 'Solo numeros, 10 digitos'>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-3" align="right">
								<label >Correo</label></div>
							<div class="col-md-9">
								<input type="email" class="input_text validarCampo" id="correo_prov" name="correo_prov">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-3" align="right">
								<label >Descripción</label>
							</div>
							<div class="col-md-9">
								<textarea class="input_textarea" id="descripcion_prov" name="descripcion_prov"></textarea>
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
				 url:'../../controlador/controlador_proveedores.php?pagina='+page+'&busqueda='+busqueda+'&operador=consultar_prov',
				 beforeSend: function(objeto){
			  	},
				success:function(data){
					$("#resultado").html(data).fadeIn('slow');
				}
			})
		}
	
	$("#registrar_proveedor").on('submit',function(event){
		event.preventDefault();
		var action = $("#registrar_proveedor").attr('action');
		var data = $("#registrar_proveedor").serialize();
		$("#btn_registrar").attr("disabled","true");
		$.ajax({
			url:action,
			data: data,
			dataType:'json',
			type:'post',
			success:function(respuesta){
				//$("#alerta_prov").html(respuesta);
				if (respuesta['tipo']=='true'){
					$("#alerta_prov").html(respuesta['alerta']);
					$("#registrar_proveedor")[0].reset();
					clearAlert();
					
				}else{
					$("#alerta_prov").html(respuesta['alerta']);
				}
				$("#btn_registrar").removeAttr("disabled");
				
			},
			error:function(respuesta){
				alert(respuesta.status);
				
			}
		});
	});
	
	function estado(id){
		$.ajax({
			url:'../../controlador/controlador_proveedores.php',
			type:"POST",
			data:{operador:'estado',nit:id},
			success:function(respuesta){
				cargarTabla(1);
				
			},
			error:function(rsultado){
				alert(rsultado.status);
			}
			
		});
	}
	function traer_prov(id){
		$.ajax({
			url:'../../controlador/controlador_proveedores.php',
			dataType: "json",
			type:"POST",
			data:{operador:'traer_prov',nit:id},
			success:function(respuesta){
			
				$("#Modal").modal('show');
				
				$("#nit_prov").val(respuesta['nit']);
				$("#nombre_prov").val(respuesta['nombre']);
				$("#correo_prov").val(respuesta['correo']);
				$("#direccion_prov").val(respuesta['direccion']);
				$("#telefono_prov").val(respuesta['telefono']);
				$("#descripcion_prov").val(respuesta['descripcion']);
				$("#nit2").val(respuesta['nit']);
				
			},
			error:function(rsultado){
				alert(rsultado.status);
			}
			
		});
	}
	
	$("#actualizar_prov").on('submit',function(event){
		event.preventDefault();
		$("#btn_actualizar").attr('disabled','true');	
		$.ajax({
			url:'../../controlador/controlador_proveedores.php',
			dataType: "json",
			type:"POST",
			data:$("#actualizar_prov").serialize(),
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
	
	
</script>

</html>