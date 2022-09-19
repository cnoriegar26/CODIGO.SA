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
 
		<div class="table-responsive table-hover " style="padding-top:40px" id="tabla_compras">
						<table class="table tabla_cart">
						  <thead>
							<tr>
							  <th style="width: 25%; text-align: center" scope="col">Fecha</th>
							  <th style="width: 25%; text-align: center" scope="col">Estado</th>
							  <th style="width: 25%; text-align: center" scope="col">Total</th>
							  <th style="width: 25%; text-align: center" scope="col">Detalles</th>
							</tr>
						  </thead>
						  <tbody>
							<tr>
							  <td align="center">18-mayo-2018</td>
							  <td align="center">pendiente</td>
							  <td align="center">$ 38000</td>
							  <td align="center"><buttom title="ver detalles" class="btn boton boton_eliminar " ><span class="fa fa-download"></span></buttom></td>
							</tr>
							<tr>
							  <td align="center">18-mayo-2018</td>
							  <td align="center">pendiente</td>
							  <td align="center">$ 38000</td>
							  <td align="center"><buttom title="ver detalles" class="btn boton boton_eliminar " ><span class="fa fa-download"></span></buttom></td>
							</tr>
							<tr>
							  <td align="center">18-mayo-2018</td>
							  <td align="center">pendiente</td>
							  <td align="center">$ 38000</td>
							  <td align="center"><buttom title="ver detalles" class="btn boton boton_eliminar " ><span class="fa fa-download"></span></buttom></td>
							</tr>
							<tr>
							  <td align="center">18-mayo-2018</td>
							  <td align="center">pendiente</td>
							  <td align="center">$ 38000</td>
							  <td align="center"><buttom title="ver detalles" class="btn boton boton_eliminar " ><span class="fa fa-download"></span></buttom></td>
							</tr>
						
						  </tbody>
						</table>
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
			cargarTabla(1);
		});
	
	function cargarTabla(page){
			
			var busqueda= $("#busqueda").val();
			
			$.ajax({
				 url:'../controlador/controlador_factura.php?pagina='+page+'&busqueda='+busqueda+'&operador=consultar_comp',
				 beforeSend: function(objeto){
			  	},
				success:function(data){
					
					$("#tabla_compras").html(data).fadeIn('slow');
				}
			})
		}
</script>

</html>