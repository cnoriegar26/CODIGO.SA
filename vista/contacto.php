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
	<div class="container contenedor">
    	<div class="row">
			<div class="col-md-12 " style="margin-top: 20px; padding: 0">
				<img class="imagen_informacion" src="../img/iconos/contacto.jpg" width="100%" height="300px">
			</div>
			
			<div class="col-md-12 informacion">
			<h1>UBICACIÓN</h1>
			<p style="text-align: center!important"><span id="direccion"></span> </p>
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d986.9781655349789!2d-73.61861862724474!3d8.311477989067768!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xae5827662152e85b!2sPalacio+Hindu!5e0!3m2!1ses-419!2sco!4v1526053529588" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
			<h1>TELÉFONOS</h1>
			<p style="text-align: center!important"> <span id="telefono"></span> | <a class="icono" href="#" style="text-decoration: none; cursor: none;"><span class="fab fa-whatsapp"></span> +57 3215605690</a></p>
			<h1>HORARIOS DE ATENCIÓN</h1>
			<p style="text-align: center!important"> Lunes a Sabados 8:00 am a 12:30 pm / 2:00 pm a 6:00 pm</p>
			</div>
			
		</div>
    </div>
</section>

</body>

<?php include("pie.php"); ?> 

<script>
	
	$(document).ready(function(){
		
			datos_info();
		});
	
	function datos_info(){
			$.ajax({
				url:'../controlador/controlador_empresa.php',
				dataType: "json",
				type:"POST",
				data:{operador:'traer_empresa'},
				success:function(respuesta){
					//alert(respuesta);

					if (respuesta['tipo']=='true'){

						
						$("#direccion").html(respuesta['direccion']);
						$("#telefono").html(respuesta['telefono']);
						
					}else{
					}
				},
				error:function(rsultado){
					alert(rsultado.status);
				}

			});
		}
	

	
</script>

</html>