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
				<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Inventario</a>
		  	</li>
		  	<li class="nav-item">
				<a class="nav-link " id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Agregar Producto</a>
			</li>	
		</ul>
		
		</div>
		
		<div class="row">
		<div class="col-md-12 tab-content contenido_cuerpo" id="pills-tabContent">
	  		
	  		<!--listar productos en stock-->
	  		<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
	  			
	  		<div class="row" style="padding-top: 15px">
				<div class="col-md-3" align="right">
				<h6 style=" padding-top: 8px">Búsqueda</h6>
				</div>

				<div class="col-md-5">
					<div class="input-group mb-3">
						<input type="text" class="form-control buscador" placeholder="Código del producto o nombre" aria-label="Recipient's username" aria-describedby="basic-addon2" id="busqueda" oninput="cargar_tabla(1)">
						<div class="input-group-append">
						<button class="input-group-text buscador"><span class="fa fa-search"></span></button>
					  </div>
					</div>
				</div>

				<div class="col-md-4" align="left">
					<a type="buttom" class="btn boton_titulo" onClick="crear_pdf()">Descargar <span class="fa fa-file-pdf "></span></a>
				</div>
			</div>
			
			<div class="table-responsive table-hover" style="padding:40px" id="tabla_inventario">
					</div>			
		 	</div>
		 	
		 	<!--agregar producto al stock-->
		  	<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
			
			<div class="row titulo_tab_control" >
				<div class="col-md-12 " >
					Ingresar Producto
				</div>
			</div>
			<br>
			<div id="alerta_inve"></div>
			<br>
			<div class="row" style="padding-top: 25px">
				<div class="col-md-8 offset-1 " >
				<form action="../../controlador/controlador_inventario.php" method="post" id="registrar_inventario">
					<input type="hidden" id="operador" name="operador" value="insertar_stoc">
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4"></div>
							<div class="col-md-8" align="center">
								<span class="fab fa-product-hunt fa-3x"></span><span class="fa fa-plus fa-1x"></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Nombre</label></div>
								<div class="col-md-4">
									<input type="text" class="input_text" placeholder="codigo o nombre" oninput="consultar_prod()" id="busqueda_prod" >
								</div>
							<div class="col-md-4">
								<select class="input_text" id="nombre" name="nombre">
  									
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Proveedor</label>
							</div>
							<div class="col-md-4">
								<input type="text" class="input_text" placeholder="documento o nombre" oninput="consultar_prov()" id="busqueda_prov" >
							</div>
							<div class="col-md-4">
								<select class="input_text" id="proveedor" name="proveedor">
  									
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Cantidad</label></div>
							<div class="col-md-8">
								<input type="number" class="input_text validarCampo" id="cantidad" name="cantidad" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >fecha de vencimiento</label></div>
							<div class="col-md-8">
								<div class="input-group date" id="datetime">
								  <input type="text" class="input_text validarCampo" id="fecha_venc" name="fecha_venc"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
								</div>
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

<!--modal actualizar producto-->
<div class="modal fade letra_modal " id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
   <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header titulo_modal">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Stock</h5>
        <button type="button" class="close cerrar_modal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			
			<div class="row " style="padding-top: 25px">
				<div class="col-md-12" >
				<div id="alerta_modal"></div>
				<form action="../../controlador/controlador_inventario.php" id="actualizar_inve" method="post"> 
				<input type="hidden" id="operador" name="operador" value="actualizar_stoc">
				<input type="hidden" id="codigo2" name="codigo2" value="">
					<div class="form-group">
						<div class="row" >
							<div class="col-md-3" align="right">
								<label >Nombre</label></div>
							<div class="col-md-9">
								<input type="text" class="input_text" id="nombre_inve" name="nombre_inve" disabled >
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-3" align="right">
								<label >Proveedor</label>
							</div>
							<div class="col-md-9">
								<select class="input_text" id="proveedor_inve" name="proveedor_inve">
  									<option selected value="0">la quinta</option>
  									<option value="1">olimpica</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-3" align="right">
								<label >Fecha vencimiento</label>
							</div>
							<div class="col-md-9">
								 <input type="text" class="input_text validarCampo" id="fecha_venc_inve" name="fecha_venc_inve" ><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-3" align="right">
								<label >Cantidad del producto</label>
							</div>
							<div class="col-md-9">
								<input type="number" class="input_text validarCampo" id="cantidad_inve" name="cantidad_inve" required>
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
	<div id="prueva" ></div>
</section>
</body>

<?php include("pie.php"); ?>

<script type="text/javascript">
		
	date=new Date();
	dia=date.getDate();
	mes=date.getMonth()+1;
	año=date.getFullYear();
	hoy=año+'-'+mes+'-'+dia;

	$("#fecha_venc").datepicker({
    	 language: "es",
		 format: "yyyy-mm-dd",
		 startDate: hoy,
		 todayBtn: true
    	});
	$("#fecha_venc_inve").datepicker({
    	 language: "es",
		 format: "yyyy-mm-dd",
		 startDate: hoy,
		 todayBtn: true
    	});
	$("#imagen").fileinput({
			showUpload: false,
		});
	$("#imagen2").fileinput({
			showUpload: false
			//showCaption: false,
			//browseClass: "btn btn-primary btn-lg",
			//fileType: "any"
		});
	
	$(document).ready(function(){
			consultar_prod();
			consultar_prov();
			cargar_tabla(1);
		});
	function consultar_prod(){
		var busqueda=$("#busqueda_prod").val();
		$.ajax({
			
			url:'../../controlador/controlador_inventario.php',
			type:'post',
			data:{operador:'cargar_prod_inve',busqueda:busqueda},
			success:function(respuesta){
				
				$('#nombre').html(respuesta);
			},
			error:function(respuesta){
				alert(respuesta.status);
			}
			
		});
	}
	function consultar_prov(){
		var busqueda=$("#busqueda_prov").val();
		$.ajax({
			
			url:'../../controlador/controlador_inventario.php',
			type:'post',
			data:{operador:'cargar_prov_inve',busqueda:busqueda},
			success:function(respuesta){
				
				$('#proveedor').html(respuesta);
				$('#proveedor_inve').html(respuesta);
			},
			error:function(respuesta){
				alert(respuesta.status);
			}
			
		});
	}
	$("#registrar_inventario").on("submit",function(event){
		
		event.preventDefault();
		
		$("#btn_registrar").attr("disabled","true");
		action= $("#registrar_inventario").attr('action');
		dato= $("#registrar_inventario").serialize();
		$.ajax({
			data:dato,
			url:action,
			type:'post',
			dataType:'json',
			success: function(respuesta){
				//alert(respuesta);	
				if (respuesta['tipo']=='true'){
					$("#alerta_inve").html(respuesta['alerta']);
					$("#registrar_inventario")[0].reset();
				}else{
					$("#alerta_inve").html(respuesta['alerta']);
				}
				$("#btn_registrar").removeAttr('disabled');
				
			},
			error:function(respuesta){
				alert(respuesta.status);
			}
			
		});
		
	});
	function cargar_tabla(page){
		var busqueda=$("#busqueda").val();
		$.ajax({
			
			url:'../../controlador/controlador_inventario.php',
			type:'post',
			data:{operador:'consultar_stoc',busqueda:busqueda,pagina:page},
			success:function(respuesta){
				
				$('#tabla_inventario').html(respuesta);
			},
			error:function(respuesta){
				alert(respuesta.status);
			}
			
		});
	}
	function consultar_actu_stoc(id){
		$.ajax({
			
			url:'../../controlador/controlador_inventario.php',
			type:'post',
			data:{operador:'traer_stoc',codigo_stoc:id},
			dataType:'json',
			success:function(respuesta){
				$("#codigo2").val(respuesta['codigo_stoc']);
				$("#codigo_inve").val(respuesta['codigo_stoc']);
				$("#cantidad_inve").val(respuesta['cantidad_stoc']);
				$("#nombre_inve").val(respuesta['nombre_prod']);
				$("#proveedor_inve option[value="+ respuesta['nit_prov'] +"]").attr("selected",true);
				$("#fecha_venc_inve").val(respuesta['fecha_venc_stoc']);
			},
			error:function(respuesta){
				alert(respuesta.status);
			}
		});
		
		$("#Modal").modal('show');
	
	}
	$("#actualizar_inve").on('submit',function(event){
		event.preventDefault();
		var action = $("#actualizar_inve").attr('action');
		$.ajax({
			
			url:action,
			type:'post',
			data:$("#actualizar_inve").serialize(),
			dataType:'json',
			success:function(respuesta){
				
				$("#alerta_modal").html(respuesta['alerta']);
				cargar_tabla(1);
			},
			error:function(respuesta){
				alert(respuesta.status);
			}
			
		});
	});
	function crear_pdf(){
		
		 var html = $("#busqueda").val();
		 $.ajax({
			 url:'../../controlador/controlador_inventario.php',
			 data:{operador:'pdf_comp',busqueda:html},
			 type:'post',
			 success:function(respuesta){
				 //$("#prueva").html(respuesta);
				 window.location.href=respuesta;
			 },
			 error:function(respuesta){
				// alert(respuesta.status);
			 }
		 });
	 }
</script>
	 

</html>