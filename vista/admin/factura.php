<html >
<head>
<?php include("head.php"); ?>
</head>
<body>
<section>
	<?php include("navegador1.php"); ?>
</section>
<section class="container-fluid" >

<div class="row">
	<?php include("navegador2.php"); ?>
		
<div class="col-md-11 cuerpo ">
		<!--emcabezado del cuerpo-->
		
	<div class="col-md-12" style="padding-top: 5px">
		
		<!--encabezado tab-panel-->
		<div class="row">
		<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="margin-top: 5px">
			<li class="nav-item">
				<a class=" nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Nueva Factura</a>
		  	</li>
		  	<li class="nav-item">
				<a class="nav-link " id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"> Consultas</a>
			</li>	
		</ul>
		
		</div>
		
		<div class="row">
		<div class="col-md-12 tab-content contenido_cuerpo" id="pills-tabContent">
	  		
	  		<!--registrar compra-->
	  		<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
	  		
	  		
	  		<div class="row titulo_tab_control">
				<div class="col-md-12" >
					Registrar factura
				</div>
			</div>
	  					
			<div class="row" style="padding-top: 15px">
				<div class="col-md-3" align="right">
				<h6 style=" padding-top: 8px">Búsqueda</h6>
				</div>

				<div class="col-md-5">
					<div class="input-group mb-3">
						<input type="text" class="form-control buscador" placeholder="Identificación o nombre del cliente" aria-label="Recipient's username" aria-describedby="basic-addon2" id="busqueda_clie" oninput="cargar_clientes(1)">
						<div class="input-group-append">
						<button class="input-group-text buscador"><span class="fa fa-search"></span></button>
					  </div>
					</div>
				</div>

				<div class="col-md-4" align="left">
					<a type="buttom" class="btn boton_titulo" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Crear Cliente</a>
				</div>
			</div>
	  		
	  		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-5 ">
				<div class="collapse" id="collapseExample">
				  <div class="card colapse card-body">
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-10" align="center" style="border-bottom: 1px solid  rgba(177,170,170,0.5)">Crear Cliente</div>
						<div class="col-md-1"></div>
					</div>
					<div id="alerta_clie"></div>
					<div class="row" style="padding-top: 20px">
					<div class="col-md-1"></div>
					<div class="col-md-10" >	
					<form action="../../controlador/controlador_clientes.php" method="post" id="registrar_cliente">
					<input type="hidden" value="registrar_clie" id="operador" name="operador">
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
							<button type="submit" class="btn boton_form  validarFormulario"><span class="fa fa-save fa-2x" id="btn_registrar"></span><br>Guardar</button>
							</div>
						</div>
				</div>
				</form>
			</div>
					<div class="col-md-1"></div>
					</div>
				  </div>
				</div>
			</div>	</div>
	  		
	  		<div class="table-responsive table-hover " style="padding:20px" id="clie">
				
			</div> 	
			
		 	</div>
		 	
		 	<!--listar factura-->  	
		 	<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
			
			<div class="row" style="padding-top: 15px">
				<div class="col-md-3" align="right">
				<h6 style=" padding-top: 8px">Búsqueda</h6>
				</div>

				<div class="col-md-5">
					<div class="input-group mb-3">
						<input type="text" class="form-control buscador" placeholder="Identificación o nombre" id="busqueda" aria-label="Recipient's username" aria-describedby="basic-addon2" oninput="cargar_factura(1)">
						<div class="input-group-append">
						<button class="input-group-text buscador"><span class="fa fa-search"></span></button>
					  </div>
					</div>
				</div>
			</div>
			
			<div class="table-responsive table-hover " style="padding:20px" id="tabla_fact">
						<table class="table ">
						  <thead>
							<tr>
							  <th style="width: 10%" scope="col">N° Factura</th>
							  <th style="width: 20%" scope="col">Fecha</th>
							  <th style="width: 20%" scope="col">Cliente</th>
							  <th style="width: 20%" scope="col">Vendedor</th>
							  <th style="width: 17%" scope="col">Total</th>
							  <th style="width: 17%" scope="col">Detalle</th>
							</tr>
						  </thead>
						  <tbody>
							<tr>
							  <th scope="row">1</th>
							  <td>21-marzo-2018</td>
							  <td>jose luis clavijo</td>
							  <td>victor julio ossa</td>
							  <td>31,000.00</td>
							  <td>
							  	<buttom title="ver detalles" class="btn boton_titulo" >Ver detalles</buttom>
							  </td>
							
						  </tbody>
						</table>
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
		cargar_clientes(1);
		cargar_factura(1);
	});
	

	
	function cargar_clientes(page){
		var busqueda= $("#busqueda_clie").val();
			
			$.ajax({
				 url:'../../controlador/controlador_factura.php?pagina='+page+'&busqueda='+busqueda+'&operador=consultar_clie',
				 beforeSend: function(objeto){
			  	},
				success:function(data){
					
					$("#clie").html(data).fadeIn('slow');
				},
				error:function(respuesta){
					alert(respuesta.status);
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
					//$("#alerta_clie").html(respuesta['alerta']);
					clearAlert();
					window.location.href="crear_factura.php?cliente="+$("#documento").val();
					
					/*$("#busqueda_clie").val($("#documento").val());
					cargar_clientes(1);
					$("#registrar_cliente")[0].reset();*/
					
					
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
	function cargar_factura(page){
		var busqueda= $("#busqueda").val();
			
			$.ajax({
				 url:'../../controlador/controlador_factura.php?pagina='+page+'&busqueda='+busqueda+'&operador=consultar_fact',
				 beforeSend: function(objeto){
			  	},
				success:function(data){
					
					$("#tabla_fact").html(data).fadeIn('slow');
				}
			})
	}
	function detalle(url){
		 window.open(url, '_blank');
	}
	</script>

</html>