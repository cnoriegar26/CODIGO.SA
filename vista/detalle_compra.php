<html >
<head>
<?php include("head.php"); ?>
<link rel="stylesheet" href="../css/general_index.css">
</head>
<body>


<section>
	<?php include("barra.php"); ?>
</section>
<section>
	<?php include("navegador_3.php");?>
</section>

<section>
	<div class="container contenedor contenedor_cart">
   	
    <div class="row">
    
		<?php
				$codigo = 0;
				if(isset($_REQUEST['codigo'])){
					$codigo = $_REQUEST['codigo'];					
				}
			?>
		<input type="hidden" id="cod" value="<?php echo $codigo ?>">	
		<div class="table-responsive table-hover " style="padding-top:40px" id="tabla_car"></div>
		<div class="col-md-4">
					<div class="row">
						<div class="col-md-12 titulo_registro">Datos del pedido</div>
					</div>
				</div>
		
		
				<div class="table-responsive " style="padding-top:20px" >
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
</section>


<section>
	<?php include("footer.php"); ?>
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
			url:'../controlador/controlador_carrito.php',
			data:{operador:'traer_compra', codigo:codigo},
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
			url:'../controlador/controlador_carrito.php',
			data:{operador:'traer_total_compra', codigo:codigo},
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
</script>

</html>