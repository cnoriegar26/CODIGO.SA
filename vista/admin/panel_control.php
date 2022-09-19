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
				<a class=" nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Informes de Gestión</a>
			</li>	
		</ul>
		
		</div>
		
		<div class="row">
		<div class="col-md-12 tab-content contenido_cuerpo" id="pills-tabContent">
	  		
	  		<!--informacion-->
	  		<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
				
			<div class="row titulo_tab_control">
				<div class="col-md-12" >
					Informe diario
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6">
					<div class="col-md-12" style="padding-top: 20px">
					Venta del dia 
					</div>
					<div id="alerta_reporte1"></div>
					<div class="row">
						<div class="col-md-6">
							<div class="row reporte" >
									<div class="col-md-12 titulo_rep" >Venta neta</div>
								<div class="col-md-12 cuerpo_rep" id="neta">$0</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row reporte">
								<div class="col-md-12 titulo_rep" >I.V.A</div>
								<div class="col-md-12 cuerpo_rep" id="iva">$0</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row reporte">
								<div class="col-md-12 titulo_rep" >Venta total</div>
								<div class="col-md-12 cuerpo_rep" id="venta_total">$0</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row reporte">
								<div class="col-md-12 titulo_rep" >Facturas</div>
								<div class="col-md-12 cuerpo_rep" id="cantidad_fact">0</div>
							</div>
						</div>
					</div>
					
				</div>
				<div class="col-md-6">
					<div class="col-md-12" style="padding-top: 20px">
					Venta del dia por categoria
					</div>
					<table class="table table-responsive table-hover tabla" >
						  <thead>
							<tr>
							  <th style="width: 10%" scope="col">Categoria</th>
							  <th style="width: 10%" scope="col">Cantidad</th>
							  <th style="width: 80%; text-align: center" scope="col">Porcentaje en venta</th>
							</tr>
						  </thead>
						  <tbody id="grafica2">
							
							
							
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

<script type="text/javascript">
		
	$("#imagen").fileinput({
			showUpload: false
		});
	var date=new Date();
	var dia=date.getDate();
	var mes=date.getMonth()+1;
	var año=date.getFullYear();
	var hoy=año+'-'+mes+'-'+dia;
	var mañana =año+'-'+mes+'-'+(dia*1+1);
	$(document).ready(function(){
		traer_reporte2();
		traer_reporte1();
	});
	function traer_reporte2(){
		$.ajax({
			
			url:'../../controlador/controlador_reporte.php',
			type:'post',
			data:{operador:'consultar_ventas_tipo',start2:hoy,end2:mañana},
			success:function(respuesta){
				
				$("#grafica2").html(respuesta);
				
			}
		});
	}
	function traer_reporte1(){
		$("#venta_total").html('0');
		$("#cantidad_fact").html('0');
		$("#iva").html('0');
		$("#neta").html('0');
		$.ajax({
			
			url:'../../controlador/controlador_reporte.php',
			type:'post',
			dataType:'json',
			data:{operador:'consultar_ventas_totales',start:hoy,end:mañana},
			success:function(respuesta){
				
				if (respuesta['typo']=='true'){
					var labels=new Array();
					var vector=new Array();
					var aclumulador=0;
					var aclumulador2=0;
					$.each(respuesta['valores'],function(index,element){
						labels.push(element['fecha']);
						vector.push(element['total']);
						aclumulador =aclumulador + element['total'];
						aclumulador2 =aclumulador2 + element['cantidad'];
						$("#venta_total").html(aclumulador);
						$("#cantidad_fact").html(aclumulador2);
					});
					var iva = aclumulador*0.19;
					var neta = aclumulador-iva;
					$("#iva").html(iva);
					$("#neta").html(neta);
					$("#alerta_reporte1").html('');
				}else{
					$("#alerta_reporte1").html(respuesta['alerta']);
				}
			}
		});
	}
</script>

</html>