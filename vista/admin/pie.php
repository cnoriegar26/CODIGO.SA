<script src="../../js/jquery-3.3.1.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/fontawesome-all.min.js"></script>
<script src="../../js/bootstrap-datepicker.js"></script>
<script src="../../js/bootstrap-datepicker.es.min.js"></script>
<script src="../../js/fileinput.js"></script>
<script src="../../js/Chart.min.js"></script>
<script src="../../js/chartjs-demo.js"></script>
<script src="../../js/validacion.js"></script>
<script>
$(document).ready(function(){
			cantidad();
		});
	
	function cantidad(){
			
			$.ajax({
				 url:'../../controlador/controlador_factura.php?operador=cantidad_pedi',
				 beforeSend: function(objeto){
			  	},
				success:function(data){
					
					$("#numero").html(data).fadeIn('slow');
				}
			})
		}
</script>