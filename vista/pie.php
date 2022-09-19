<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/fontawesome-all.min.js"></script>
<script type="text/javascript" src="../js/validacion.js"></script>


<script type="application/javascript">

$(document).ready(function(){
	var altura = $('.menu').offset().top;
	
	$(window).on('scroll', function(){
		if ( $(window).scrollTop() > altura ){
			$('.menu').addClass('menu-fixed');
		} else {
			$('.menu').removeClass('menu-fixed');
		}
	});
	
	<?php
		if (isset($_SESSION['documento'])){
			?>
				cargar_addom();
			<?php
		}
	?>
 	datos_empresa();
});
	
$("#sesion_usua").on('submit',function(event){
		event.preventDefault();
		$("#iniciar").attr('disabled');
		var data = $("#sesion_usua").serialize();
		var action = $("#sesion_usua").attr('action');
	//alert(action);
		$.ajax({
			url:action,
			data:data,
			type:'POST',
			dataType:'json',
			success:function(respuesta){
			//alert(respuesta);
				if (respuesta['tipo']=='true'){
					location.reload();
				}else{
					$("#alerta_sesion").html(respuesta['alerta']);
				}
				$("#iniciar").removeAttr('disabled');
			},
			error: function(respuesta){
				alert(respuesta.status);
			}
			
			
		});
});
	
function cargar_addom(){
	$.ajax({
			url:'../controlador/controlador_carrito.php',
			data:{operador:'traer_addom'},
			type:'POST',
			success:function(respuesta){
				$("#addom").html(respuesta);
				
			},
			error: function(respuesta){
				//alert(respuesta.status);
			}
			
			
		});
}
	function datos_empresa(){
		$.ajax({
			url:'../controlador/controlador_empresa.php',
			dataType: "json",
			type:"POST",
			data:{operador:'traer_empresa'},
			success:function(respuesta){
				//alert(respuesta);
				
				if (respuesta['tipo']=='true'){
					
					var htmldata='<P>Horarios de atención: Lunes a Sabados 8:00 am a 12:30 pm / 2:00 pm a 6:00 pm<br>correo: '+respuesta['correo']+'<br>Contacto: '+respuesta['telefono']+'<br>'+respuesta['direccion']+' Aguachica-Cesar</P>';
					$('#data_empresa').html(htmldata);
				}else{
				//$("#operador").val('registrar_empresa');
				}
			},
			error:function(rsultado){
				//alert(rsultado.status);
			}
			
		});
	}
</script>