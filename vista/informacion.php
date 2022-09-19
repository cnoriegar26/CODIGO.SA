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
				<img class="imagen_informacion" src="../img/iconos/informacion.jpg" width="100%" height="300px">
			</div>
			
			<div class="col-md-12 informacion">
			<h1>MISIÓN</h1>
			<div id="mision"></div>
			
			<h1>VISIÓN</h1>
			<div id="vision"></div>
			
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
					
					var htmlmision='<p>'+respuesta['mision']+'</p>';
					var htmlvision='<p>'+respuesta['vision']+'</p>';
					$("#mision").html(htmlmision);
					$("#vision").html(htmlvision);
				}else{
				$("#operador").val('registrar_empresa');
				}
			},
			error:function(rsultado){
				alert(rsultado.status);
			}
			
		});
	}
	</script>

</html>