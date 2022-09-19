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
				<a class=" nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Nueva Compra</a>
		  	</li>
		  	<li class="nav-item">
				<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" onClick="cargarTabla(1)"> Consulta</a>
			</li>	
		</ul>
		
		</div>
		
		<div class="row">
		<div class="col-md-12 tab-content contenido_cuerpo" id="pills-tabContent">
	  		
	  		<!--registrar compra-->
	  		<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
	  		
	  		<div class="row titulo_tab_control">
				<div class="col-md-12" >
					Registro de Compra
				</div>
			</div>
			<br>
			<div id="alerta_comp"></div>
			<br>
			<form action="../../controlador/controlador_compra.php" id="registrar_compra" method="post" enctype="multipart/form-data">
			<div class="row" style="padding-top: 25px; padding-bottom: 25px" >
				<div class="col-md-1"></div>
					
				<div class="col-md-8">
				
				
				<input type="hidden" id="operador" name="operador" value="insertar_comp">
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4"></div>
							<div class="col-md-8" align="center">
								<span class="far fa-money-bill-alt fa-3x"></span> <span class="fa fa-plus fa-1x"></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Código de factura</label></div>
							<div class="col-md-8">
								<input type="number" class="input_text validarCampo" id="codigo_fact" name="codigo_fatc" title = 'Solo Numeros' required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Proveedor</label>
							</div>
							<div class="col-md-8">
							<div class="row">
								<div class="col-md-6">
 									<input type="text" class="input_text" id="busqueda_prov" name="busqueda_prov" oninput="consultar_prov()">
								</div>
								<div class="col-md-6">
									<select class="input_text validarCampo" id="proveedor" name="proveedor" required>
  									<option selected value="0">la quinta</option>
  									<option value="1">olimpica</option>
									</select>
								</div>
							</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >valor</label></div>
							<div class="col-md-8">
								<input type="number" class="input_text validarCampo" id="valor" name="valor" title = 'Solo Numeros' required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >fecha de Compra</label></div>
							<div class="col-md-8">
								<div class="input-group date" id="datetime">
								  <input type="text" class="input_text validarCampo" id="fecha_compra" name="fecha_compra" required><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row" >
							<div class="col-md-4" align="right">
								<label >Imagen factura</label></div>
							<div class="col-md-8">
								 <input class="archivo validarCampo" type="file" multiple id="imagen" name="imagen" accept="image/*" required>
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
		 	
		 	<!--listar compras-->  	
		 	<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
			
			<div class="row" style="padding-top: 15px">
				<div class="col-md-3" align="right">
				<h6 style=" padding-top: 8px">Búsqueda</h6>
				</div>

				<div class="col-md-5">
					<div class="input-group mb-3">
						<input type="text" class="form-control buscador" placeholder="Código de factura o nit del proveedor" id="busqueda" aria-label="Recipient's username" aria-describedby="basic-addon2" oninput="cargarTabla(1)">
						<div class="input-group-append">
						<button class="input-group-text buscador"><span class="fa fa-search"></span></button>
					  </div>
					</div>
				</div>

				<div class="col-md-4" align="left">
					<a type="buttom" class="btn boton_titulo" onClick="crear_pdf()">Descargar <span class="fa fa-file-pdf"></span></a>
				</div>
				</div>
				
				<div class="table-responsive table-hover" style="padding:40px" id="tabla_compra">
						<table class="table">
						  <thead>
							<tr>
							  <th style="width: 20%" scope="col">Código factura</th>
							  <th style="width: 20%" scope="col">Proveedor</th>
							  <th style="width: 20%" scope="col">Valor</th>
							  <th style="width: 20%" scope="col">Fecha</th>
							  <th style="width: 20%" scope="col">Factura</th>
							</tr>
						  </thead>
						  <tbody>
							<tr>
							  <th scope="row">00059</th>
							  <td>Olimpica</td>
							  <td>3,000.00</td>
							  <td>16-marzo-2018</td>
							  <td>
							  	<a id="example8" href="../../img/iconos/factura.jpg"><img alt="example8" height="30px" width="30px" src="../../img/iconos/factura.jpg" /></a>
							  </td>
							</tr>
							
							
						  </tbody>
						</table>
					</div>
					
			</div>
		  
		  	</div>
		</div>
		</div>	
		
	</div>
		
</div>

</div>
	<div id="prueva"></div>
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
	
	$("#imagen").fileinput({
			showUpload: false
		});
	
	$("a#example2").fancybox({
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic'
			});
</script>
 
 <script type="text/javascript">
		$(document).ready(function() {
			/*
			*   Examples - images
			*/

			$("a#example1").fancybox();

			$("a#example2").fancybox({
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic'
			});

			$("a#example3").fancybox({
				'transitionIn'	: 'none',
				'transitionOut'	: 'none'	
			});

			$("a#example4").fancybox({
				'opacity'		: true,
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'none'
			});

			$("a#example5").fancybox();

			$("a#example6").fancybox({
				'titlePosition'		: 'outside',
				'overlayColor'		: '#000',
				'overlayOpacity'	: 0.9
			});

			$("a#example7").fancybox({
				'titlePosition'	: 'inside'
			});

			$("a#example8").fancybox({
				'titlePosition'	: 'over'
			});

			$("a[rel=example_group]").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});

			/*
			*   Examples - various
			*/

			$("#various1").fancybox({
				'titlePosition'		: 'inside',
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});

			$("#various2").fancybox();

			$("#various3").fancybox({
				'width'				: '75%',
				'height'			: '75%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});

			$("#various4").fancybox({
				'padding'			: 0,
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});
		});
	 
	 $(document).ready(function(){
			consultar_prov();
		 cargarTabla(1);
		});
	 
	 $("#registrar_compra").on("submit",function(event){
		
		event.preventDefault();
		
		$("#btn_registrar").attr("disabled","true");
		action= $("#registrar_compra").attr('action');
		formdato= new FormData($("#registrar_compra")[0]);
		 
		$.ajax({
			data:formdato,
			url:action,
			type:'post',
			dataType:'json',
			contentType: false,
            processData: false,
			success: function(respuesta){
				
				if (respuesta['tipo']=='true'){
					$("#alerta_comp").html(respuesta['alerta']);
					$("#registrar_compra")[0].reset();
					clearAlert();
				}else{
					$("#alerta_comp").html(respuesta['alerta']);
				}
				$("#btn_registrar").removeAttr('disabled');
				
			},
			error:function(respuesta){
				alert(respuesta.status);
			}
			
		});
		
	});
	 function consultar_prov(){
		var busqueda=$("#busqueda_prov").val();
		$.ajax({
			
			url:'../../controlador/controlador_inventario.php',
			type:'post',
			data:{operador:'cargar_prov_inve',busqueda:busqueda},
			success:function(respuesta){
				
				$('#proveedor').html(respuesta);
				
			},
			error:function(respuesta){
				alert(respuesta.status);
			}
			
		});
	}
	 function cargarTabla(page){
		 var busqueda=$("#busqueda").val();
		$.ajax({
			
			url:'../../controlador/controlador_compra.php',
			type:'post',
			data:{operador:'consultar_comp',busqueda:busqueda,pagina:page},
			success:function(respuesta){
				
				$('#tabla_compra').html(respuesta);
			},
			error:function(respuesta){
				alert(respuesta.status);
			}
			
		});
	 }
	 function crear_pdf(){
		 var html = $("#busqueda").val();
		 $.ajax({
			 url:'../../controlador/controlador_compra.php',
			 data:{operador:'pdf_comp',busqueda:html},
			 type:'post',
			 success:function(respuesta){
				 //$("#prueva").html(respuesta);
				 window.location.href=respuesta;
			 },
			 error:function(respuesta){
				 alert(respuesta.status);
			 }
		 });
	 }
	</script>
	 
	 

</html>