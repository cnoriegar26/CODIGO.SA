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
		
		<!--<div class="col-md-4">
			<div class="row">
				<div class="col-md-12 titulo_registro">Datos del envió</div>
				<div class="col-md-12" style="padding: 0; padding-top: 20px">
					<input class="datos_envio" type="text" disabled value="Yeiny Quintero Quintero"><br>
					<input class="datos_envio" type="text" disabled value="Calle 24 a # 8 – 24 Potosí Aguachica"><br>
					<input class="datos_envio" type="text" disabled value="315 958 0928">

					<button class="boton_editar"><span class="fa fa-edit"></span> Editar</button>
				</div>
			</div>
		</div>-->
		
		<div class="table-responsive table-hover " style="padding-top:20px" id="tabla_car">
					
						<table class="table tabla_cart">
						  <thead>
							<tr>
							  <th style="width: 13%" scope="col"></th>
							  <th style="width: 10%" scope="col">Producto</th>
							  <th style="width: 37%" scope="col">Descripción</th>
							  <th style="width: 10%" scope="col">Precio</th>
							  <th style="width: 10%" scope="col">Cantidad</th>
							  <th style="width: 10%; text-align: center" scope="col">Precio total</th>
							  <th style="width: 10%; text-align: center" scope="col" align="center">Eliminar</th>
							</tr>
						  </thead>
						  <tbody>
							<tr>
							  <td style="text-align: center"><img src="../img/productos/producto1.jpg" height="50px" width="50pxs"></td>
							  <td>marihuna</td>
							  <td align="justify">Droga que se obtiene de la mezcla de hojas y flores secas del cáñamo índico con sustancias aromáticas.</td>
							  <td>2,000.00</td>
							  <td><input class="input_number" type="number"></td>
								<td align="center" >
									10,000.00
						  		</td>
							  	
							  	<td align="center" >
							  		<buttom title="Eliminar" class="btn boton boton_eliminar" ><span class="fa fa-trash-alt"></span></buttom>
							  	</td>
							</tr>
							<tr>
							  <td style="text-align: center"><img src="../img/productos/producto1.jpg" height="50px" width="50pxs"></td>
							  <td>marihuna</td>
							  <td align="justify">Droga que se obtiene de la mezcla de hojas y flores secas del cáñamo índico con sustancias aromáticas.</td>
							  <td>2,000.00</td>
							  <td><input class="input_number" type="number"></td>
								<td align="center" >
									10,000.00
						  		</td>
							  	
							  	<td align="center" >
							  		<buttom title="Eliminar" class="btn boton boton_eliminar " ><span class="fa fa-trash-alt"></span></buttom>
							  	</td>
							</tr>  
						
						  </tbody>
						</table>
					</div>
		
				<div class="col-md-4">
					<div class="row">
						<div class="col-md-12 titulo_registro">Datos de la factura</div>
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
							  <td>10,000.00</td>
							</tr>
							<tr>
							  <td></td>
							  <td></td>
							  <td></td>
							  <th>Total a pagar</th>	
							  <td id="total">20,000.00</td>
							</tr>
						
						  </tbody>
						</table>
					</div>
			</div>
			
		 <button type="button" href="confirm.php" class="boton_iniciar" id="btn_redirect" onClick="redirect()">REALIZAR COMPRA</button>
		 <div id="alerta_confirm"></div>
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
		$.ajax({
			url:'../controlador/controlador_carrito.php',
			data:{operador:'traer_carrito'},
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
			$.ajax({
			url:'../controlador/controlador_carrito.php',
			data:{operador:'traer_total'},
			type:'POST',
			dataType:'json',
			success:function(respuesta){
				//$("#total").html(respuesta);
				if(respuesta['tipo']=='true'){
					$("#total").html(respuesta['total']);
					$("#amount").val(respuesta['total']);
				}else{
					$("#total").html(0);
					$("#amount").val(0);
					$("#btn_redirect").attr('disabled','true');
					
				}
				
			},
			error: function(respuesta){
				alert(respuesta.status);
			}
		});
	}
	function eliminar(id){
		$.ajax({
			url:'../controlador/controlador_carrito.php',
			data:{operador:'eliminar_car',codigo:id},
			type:'POST',
			success:function(respuesta){
			
				if (respuesta!='false'){
					location.reload();
				}else{
					alert(respuesta);
				}
				
			},
			error: function(respuesta){
				alert(respuesta.status);
			}
		});
	}
	function agregar(codigo){
		var cantidad = $("#p_c"+codigo).val();
		$.ajax({
			url:'../controlador/controlador_carrito.php',
			data:{operador:'agregar_car',codigo:codigo,cantidad:cantidad},
			type:'POST',
			success:function(respuesta){
			//alert(respuesta);
				if (respuesta!='false'){
					cargar_carrito();
					traer_total();
				}else{
					alert(respuesta);
				}
				
			},
			error: function(respuesta){
				alert(respuesta.status);
			}
		});
	}
	function redirect(){
		
		$.ajax({
			url:'../controlador/controlador_carrito.php',
			data:{operador:'confirm_inve'},
			type:'POST',
			dataType:'json',
			success:function(respuesta){
			//alert(respuesta);
				if (respuesta['tipo']!='false'){
					
					$("#alerta_confirm").html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+respuesta['mensaje']+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					
				}else{
					window.location.href='confirm.php';
				}
				
			},
			error: function(respuesta){
				alert(respuesta.status);
			}
		});
		
	}
</script>

</html>