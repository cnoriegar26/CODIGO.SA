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
				<a class=" nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Consulta</a>
		  	</li>
		  	<li class="nav-item">
				<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Nuevo Producto</a>
			</li>	
		</ul>
		
		</div>
		
		<div class="row">
		<div class="col-md-12 tab-content contenido_cuerpo" id="pills-tabContent">
	  		
	  		<!--Listar producto-->
	  		<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
	  		
	  		<div class="row" style="padding-top: 15px">
				<div class="col-md-3" align="right">
				<h6 style=" padding-top: 8px">Búsqueda</h6>
				</div>

				<div class="col-md-5">
					<div class="input-group mb-3">
						<input type="text" class="form-control buscador" placeholder="Código del producto o nombre" id="busqueda" oninput="cargarTabla(1)" aria-label="Recipient's username" aria-describedby="basic-addon2">
						<div class="input-group-append">
						<button class="input-group-text buscador"><span class="fa fa-search"></span></button>
					  </div>
					</div>
				</div>
			</div>
			
			<div class="table-responsive table-hover" style="padding:40px" id="resultado">
						
					</div>
			
		 	</div>
		 	
		 	<!--crear producto-->
		  	<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
			
			<div class="row titulo_tab_control">
				<div class="col-md-12" >
					Crear Producto
				</div>
			</div>
			<div id="alerta_prod" class="col-12"></div>
			<form class="col-12" action="../../controlador/controlador_producto.php" id="registrar_producto" method="post" enctype="multipart/form-data">
			<div class="row" style="padding-top: 25px; padding-bottom: 25px" >
			
				
				<div class="col-md-8" >
				
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4"></div>
							<div class="col-md-8" align="center">
								<span class="fab fa-product-hunt fa-3x"></span><span class="fa fa-plus fa-1x"></span>
							</div>
						</div>
					</div>
					
					<input type="hidden" id="operador" name="operador" value="registrar_prod">
					
					<!--<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Código</label></div>
							<div class="col-md-8">
								<input type="number" class="input_text validarCampo" id="codigo" name="codigo" required>
							</div>
						</div>
					</div>-->
					
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Nombre</label></div>
							<div class="col-md-8">
								<input type="text" class="input_text validarCampo" id="nombre" name="nombre" pattern="[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{2,50}" title = 'Solo letras, de 2 a 50 caracteres' required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Descripción</label></div>
							<div class="col-md-8">
								<textarea class="input_textarea validarCampo" id="descripcion" name="descripcion"></textarea>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Precio</label></div>
							<div class="col-md-8">
								<input type="number" class="input_text validarCampo" id="precio" name="precio" >
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Cantidad</label></div>
							<div class="col-md-8">
								<input type="number" class="input_text validarCampo" id="cantidad" name="cantidad">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >fecha de vencimiento</label></div>
							<div class="col-md-8">
								<div class="input-group date" id="datetime">
								  <input type="text" class="input_text validarCampo" id="fecha_venc" name="fecha_venc" ><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Proveedor</label>
							</div>
							<div class="col-md-8">
								<select class="input_text validarCampo" id="proveedor" name="proveedor">
  									
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Tipo</label>
							</div>
							<div class="col-md-8">
								<select class="input_text validarCampo" id="tipo" name="tipo">
  									
								</select>
							</div>
						</div>
					</div>
					
				</div>
				<div class="col-md-4">
					<div class="row" >
							<div class="col-md-12"  style="padding-top: 30px">
								<label >Imagen</label>
							</div>
						</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-12">
								<input type="file" multiple class="validarCampo" id="foto" name="foto" accept="image/*" required >
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
					
				</div>
				
			</div>
		  </form>
		  	</div>
		  	
		</div>
		</div>	
		
	</div>
		
</div>

</div>

<!--modal actualizar producto-->
<div class="modal fade letra_modal " id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
   <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header titulo_modal">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Producto</h5>
        <button type="button" class="close cerrar_modal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			
			<div class="row " style="padding-top: 25px">
				<div class="col-md-12" >
				<form action="../../controlador/controlador_producto.php" id="actualizar_producto" method="post" enctype="multipart/form-data">
				<input type="hidden" id="operador2" name="operador" value="actualizar_prod">
				<input type="hidden" id="codigo2" name="codigo2" value="">
				<div id="alerta_modal"></div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-3" align="right">
								<label >Código</label></div>
							<div class="col-md-9">
								<input type="text" class="input_text" id="codigo_prod" name="codigo_prod" disabled >
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-3" align="right">
								<label >Nombre</label></div>
							<div class="col-md-9">
								<input type="text" class="input_text validarCampo" id="nombre_prod" name="nombre_prod" pattern="[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{2,50}" title = 'Solo letras, de 2 a 50 caracteres'>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-3" align="right">
								<label >Descripción</label></div>
							<div class="col-md-9">
								<input type="text" class="input_text validarCampo" id="descripcion_prod" name="descripcion_prod" >
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-3" align="right">
								<label >precio</label></div>
							<div class="col-md-9">
								<input type="number" class="input_text validarCampo" id="precio_prod" name="precio_prod" >
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-3" align="right">
								<label >Proveedor</label>
							</div>
							<div class="col-md-9">
								<select class="input_text validarCampo" id="proveedor_prod" name="proveedor_prod">
  								
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-3" align="right">
								<label >Tipo</label>
							</div>
							<div class="col-md-9">
								<select class="input_text validarCampo" id="tipo_prod" name="tipo_prod">
  									
								</select>
							</div>
						</div>
					</div>
					<div class="row" >
						<div class="col-md-3" align="right">
								<label >Imagen</label>
							</div>
							<div class="col-md-9">
								<input type="file" class="validarCampo" multiple id="imagen2" name="imagen2" accept="image/*">
							</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-12" align="right">
							<button type="submit" class="btn boton_form validarFormulario" id="btn-actualizar"><span class="fa fa-save fa-2x"></span><br>Guardar</button>
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

<script type="text/javascript">
		
	date=new Date();
	dia=date.getDate();
	mes=date.getMonth()+1;
	año=date.getFullYear();
	hoy=año+'-'+mes+'-'+dia;

	$("#datetime").datepicker({
    	 language: "es",
		 format: "yyyy-mm-dd",
		 startDate: hoy,
		 todayBtn: true
    	});
	
	$("#foto").fileinput({
			showUpload: false
		});
	$("#imagen2").fileinput({
			showUpload: false
		});
	
	$(document).ready(function(){
			cargarProv();
			cargarTipo();
			cargarTabla(1);
		});
	
	function cargarTabla(page){
			
			var busqueda= $("#busqueda").val();
			
			$.ajax({
				 url:'../../controlador/controlador_producto.php?pagina='+page+'&busqueda='+busqueda+'&operador=consultar_prod',
				 beforeSend: function(objeto){
			  	},
				success:function(data){
					
					$("#resultado").html(data).fadeIn('slow');
				}
			})
	}
	
	function cargarProv(){
		$.ajax({
			
			url:'../../controlador/controlador_producto.php',
			type:'post',
			data:{operador:'cargar_prov'},
			success:function(respuesta){
				
				$('#proveedor').html(respuesta);
				$('#proveedor_prod').html(respuesta);
			},
			error:function(respuesta){
				alert(respuesta.status);
			}
			
		});
	}
	function cargarTipo(){
		$.ajax({
			
			url:'../../controlador/controlador_producto.php',
			type:'post',
			data:{operador:'cargar_tipo'},
			success:function(respuesta){
				
				$('#tipo').html(respuesta);
				$('#tipo_prod').html(respuesta);
			},
			error:function(respuesta){
				alert(respuesta.status);
			}
			
		});
	}
	
	$("#registrar_producto").on("submit",function(event){
		
		event.preventDefault();
		
		$("#btn_registrar").attr("disabled","true");
		action= $("#registrar_producto").attr('action');
		formdato= new FormData($("#registrar_producto")[0]);
		$.ajax({
			data:formdato,
			url:action,
			type:'post',
			dataType:'json',
			contentType: false,
            processData: false,
			success: function(respuesta){
				//$("#alerta_prod").html(respuesta);
				if (respuesta['tipo']=='true'){
					$("#alerta_prod").html(respuesta['alerta']);
					clearAlert();
					location.reload();
				}else{
					$("#alerta_prod").html(respuesta['alerta']);
				}
				$("#btn_registrar").removeAttr('disabled');
				
			},
			error:function(respuesta){
				alert(respuesta.status);
			}
			
		});
		
	});
	function estado(id){
		$.ajax({
			url:'../../controlador/controlador_producto.php',
			type:"POST",
			data:{operador:'estado',codigo:id},
			success:function(respuesta){
				cargarTabla(1);
				
			},
			error:function(rsultado){
				alert(rsultado.status);
			}
			
		});
	}
	function traer_prod(id){
		$.ajax({
			url:'../../controlador/controlador_producto.php',
			dataType: "json",
			type:"POST",
			data:{operador:'traer_prod',codigo:id},
			success:function(respuesta){
				$("#Modal").modal('show');
				$("#codigo2").val(respuesta['codigo_prod']);
				$("#codigo_prod").val(respuesta['codigo_prod']);
				$("#nombre_prod").val(respuesta['nombre_prod']);
				$("#descripcion_prod").val(respuesta['descripcion_prod']);
				$("#precio_prod").val(respuesta['precio_prod']);
				$("#proveedor_prod option[value="+ respuesta['nit_prov'] +"]").attr("selected",true);
				$("#tipo_prod option[value="+ respuesta['codigo_tipo'] +"]").attr("selected",true);
				
			},
			error:function(rsultado){
				alert(rsultado.status);
			}
			
		});
	}
	$("#actualizar_producto").on("submit",function(event){
		event.preventDefault();
		$("#btn_actualizar").attr("disabled","true");
		var action= $("#actualizar_producto").attr('action');
		var formdato= new FormData($("#actualizar_producto")[0]);
		$.ajax({
			url:action,
			type:'POST',
			dataType:'json',
			data:formdato,
			contentType: false,
            processData: false,
			success:function(respuesta){
				$("#alerta_modal").html(respuesta['alerta']);
				cargarTabla(1);
				$("#btn_actualizar").removeAttr('disabled');
				clearAlert();
				
			},
			error:function(prespuesta){
				alert(respuesta);
				
			}
		});
	});
	
	
	
</script>
	 

</html>