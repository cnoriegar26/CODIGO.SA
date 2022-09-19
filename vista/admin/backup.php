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
				<a class=" nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Copia de seguridad</a>
		  	</li>
		</ul>
		
		</div>
		
		<div class="row">
		<div class="col-md-12 tab-content contenido_cuerpo" id="pills-tabContent">
	  		
	  		<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
	  		
	  		<div class="row titulo_tab_control">
				<div class="col-md-12" >
					Descargar respaldo
				</div>
			</div>
			<div id="result"></div>
			<div class="row">
				<div class="col-md-12 ">
					
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8" style="padding: 20px" >
							<a type="buttom" class="btn boton_titulo" onclick="crear_backup()">Descargar <span class="fa fa-download "></span></a>
						</div>
					</div>
					
					<div class="row"  >
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<div class="input-group mb-3" >
							<h6 style=" padding-top: 8px; padding-right: 10px; padding-left: 5px">Búsqueda</h6> 
								<input type="text" class="form-control buscador" placeholder="Fecha descarga" aria-label="Recipient's username" aria-describedby="basic-addon2" id="busqueda"  oninput="traer_backup()">
								<div class="input-group-append">
								<button class="input-group-text buscador"><span class="fa fa-search"></span></button>
							  </div>
							</div>
						</div>

					</div>
			
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8" style="padding: 20px" >
							Copias realizadas
						</div>					
					</div>
					
					<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8 table-responsive table-hover " id="copias_realizadas">			
						<table class="table ">
						  <thead>
							<tr>
							  <th style="width: 30%" scope="col">Fecha </th>
							  <th style="width: 37%" scope="col">Usuario</th>
							  <th style="width: 33%" scope="col">Descargar</th>
							</tr>
						  </thead>
						  <tbody>
							<tr>
							  <td>16-marzo-2018</td>
							  <td>victor julio</td>
							  <td><buttom title="Descargar" class="btn boton" ><span class="fa fa-download"></span></buttom></td>
							 </tr>
							 <tr>
							  <td>16-marzo-2018</td>
							  <td>Andrea</td>
							  <td><buttom title="Descargar" class="btn boton" ><span class="fa fa-download"></span></buttom></td>
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
		
</div>

</div>
	
</section>
</body>

<?php include("pie.php"); ?>
<script>
	
	$(document).ready(function(){
			traer_backup();
		});
	
	function crear_backup(){
		$.ajax({
			url:"../../controlador/controlador_backup.php",
			data:{operador:'crear_back'},
			type:'POST',
			dataType:'json',
			success:function(respuesta){
				//alert(respuesta);
				if(respuesta['accion']=='1'){
					window.location.href='../../back/descargar.php';	
					traer_backup();	
					
				}else{
					$("#result").html(respuesta);
				}
				
			
			},
			error:function(respuesta){
				alert(respuesta.status);
			}
		});
	}
	function traer_backup(){
		
		$.ajax({
			url:"../../controlador/controlador_backup.php",
			data:{operador:'consultar_back',fecha_back:$("#busqueda").val()},
			type:'POST',
			success:function(respuesta){
				
				$("#copias_realizadas").html(respuesta)
				
			},
			error:function(respuesta){
				alert(respuesta.status);
			}
		});
	}
	
	</script>

</html>