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
	  		
	  		
		 	
		 	<!--listar factura-->
			<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
			
			<?php
				$codigo = 0;
				if(isset($_REQUEST['codigo'])){
					$codigo = $_REQUEST['codigo'];					
				}
			?>
			
			<input type="hidden" id="cod" value="<?php echo $codigo ?>">
			<div class="table-responsive table-hover " style="padding:20px" id="tabla_car"></div>
		  	<div class="col-md-4">
					<div class="row">
						<div class="col-md-12 titulo_registro">Datos del pedido</div>
					</div>
				</div>
		
		
				<div class="table-responsive " style="padding:20px" >
						<table class="table tabla_cart">
						  <thead>
							<tr>
							  <th style="width: 10%" scope="col"></th>
							  <th style="width: 50%" scope="col"></th>
							  <th style="width: 10%" scope="col"></th>
							  <th style="width: 15%" scope="col"></th>
							  <th style="width: 15%" scope="col"></th>
							  
							</tr>
						  </thead>
						  <tbody>
							<tr>
							  <td>Envió</td>
							  <td></td>
							  <td></td>
							  <td></td>
							  <td>$10000</td>
							</tr>
							<tr>
							  <td></td>
							  <td></td>
							  <td></td>
							  <th>Total a pagar</th>	
							  <td id="total">20,000.00</td>
							</tr>
							<tr>
							  <td></td>
							  <td></td>
							  <td></td>
							  <th></th>	
							  <td id="btn_estado"></td>
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

</section>
</body>

<?php include("pie.php"); ?>
<script>
	
	$(document).ready(function(){
		cargar_carrito();
		traer_total();
	});
	
	function cargar_carrito(){
		
		var codigo= document.getElementById("cod").value;
		$.ajax({
			url:'../../controlador/controlador_carrito.php',
			data:{operador:'traer_pedido', codigo:codigo},
			type:'POST',
			success:function(respuesta){
			
				$("#tabla_car").html(respuesta);
				
			},
			error: function(respuesta){
				alert(respuesta.status);
			}
		});
	}
	
	function traer_total(){
		
			var codigo= document.getElementById("cod").value;
			$.ajax({
			url:'../../controlador/controlador_carrito.php',
			data:{operador:'traer_total_pedido', codigo:codigo},
			type:'POST',
			dataType:'json',
			success:function(respuesta){
				//$("#total").html(respuesta);
				if(respuesta['tipo']=='true'){
					$("#total").html(respuesta['total']);
					$("#amount").val(respuesta['total']);
					if(respuesta['boton']!='false'){
						$("#btn_estado").html(respuesta['boton']);
					}
				}
				
			},
			error: function(respuesta){
				alert(respuesta.status);
			}
		});
	}
	
	function detalle(url){
		 window.open(url, '_blank');
	}
	
	function enviar(id){
		$.ajax({
			url:'../../controlador/controlador_factura.php',
			data:{operador:'enviar', codigo:id},
			type:'POST',
			success:function(respuesta){
				//alert(respuesta);
				window.open(respuesta, '_blank');
				location.reload();
				
			},
			error: function(respuesta){
				alert(respuesta.status);
			}
		});
	}
	</script>

</html>