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
				<a class=" nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Detalle pedido</a>
		  	</li>
		</ul>
		
		</div>
		
		<div class="row">
		<div class="col-md-12 tab-content contenido_cuerpo" id="pills-tabContent">
	  		
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
		 	
		 	<!--listar factura-->
			<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
			
			
			<div class="table-responsive table-hover " style="padding:20px" id="tabla_compras"></div>
		  	
		
		
				<div class="table-responsive " style="padding-top:20px" >
						
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
			cargarTabla(1);
		});
	
	function cargarTabla(page){
			
			var busqueda= $("#busqueda").val();
			
			$.ajax({
				 url:'../../controlador/controlador_factura.php?pagina='+page+'&busqueda='+busqueda+'&operador=consultar_pedi',
				 beforeSend: function(objeto){
			  	},
				success:function(data){
					
					$("#tabla_compras").html(data).fadeIn('slow');
				}
			})
		}
	
	
</script>

</html>