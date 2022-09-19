<html >
<head>
<?php include("head.php"); ?>

</head>
<body>
<section>
	<?php include("navegador1.php"); ?>
</section>
<section class="container-fluid" style="height: 100%" >
<div class="row">
	<?php include("navegador2.php"); ?>
		
<div class="col-md-11 cuerpo ">
		<!--emcabezado del cuerpo-->
		
	<div class="col-md-12" style="padding-top: 5px">
		
		<!--encabezado tab-panel-->
		<div class="row">
		<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="margin-top: 5px">
			<li class="nav-item">
				<a class=" nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Reportes</a>
		  	</li>	
		</ul>
				
		<div class="row">
		<div class="col-md-12 tab-content contenido_cuerpo2" id="pills-tabContent">
	  		
	  		<!--reporte-->
	  		<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
	  		<div class="row">
	  			<div class="col-md-6">
	  				<div class="row titulo_reporte" >
	  					<h6>Ventas por Fecha</h6>
	  				</div>
	  				<div class="row cuerpo_reporte">
	  				<div class="col-md-12">
	  					<div class="row"><h6>Rango de fecha</h6></div>
	  					<div class="row"> 
	  					
	  					<div class="input-daterange input-group" id="rango_fecha" >
									
							<div class="col-md-6 input-group mb-3 date ">
								<input type="text" name="start" id="start" class="fecha form-control" aria-describedby="basic-addon2" placeholder="fecha inicio"> 
								<div class="input-group-append ">
									<span class="ico_fec" id="basic-addon2"><span class="fa fa-calendar-alt fa-1x"></span><span class="input-group-addon"></span>
								</div>
								</div>
							<div class="col-md-6 input-group mb-3 date">
								<input type="text"name="end" id="end" class="fecha form-control" aria-describedby="basic-addon2" placeholder="fecha final"> 
								<div class="input-group-append ">
									<span class="ico_fec" id="basic-addon2"><span class="fa fa-calendar-alt"></span><span class="input-group-addon"></span>
								</div>
							</div>
								
							<div class="col-md-12" align="right">
							<button class="btn boton_titulo" onClick="traer_reporte1()">Generar</button></div>
								
						</div>
						
						<div id="alerta_reporte1" class="col-12" style="margin-top: 10px"></div>
						
						<!--<tabla  class="table-responsive">
							<tr>
								<td>
									<div class="col-md-12" align="center">
									<canvas id="bar" height="300px" width="400px" style="margin-top: 20px; margin-bottom: 20px"></canvas></div>
								</td>
							</tr>
						</tabla>-->
						
						<div id="container" style="width: 100%;height: 400px;margin: 0 auto"></div>
						
						<div class="row col-md-12" >
					
					<table class=" table-responsive table-sm tabla" >
						  <tbody>
							<tr>
							  <td align="right"><h6>Venta neta: </h6></td>
							  <td><h6 id="neta"> </h6></td>
							</tr>
							<tr>
							  <td align="right"><h6>I.V.A: </h6></td>
							  <td><h6 id="iva"></h6></td>
							</tr>
							<tr>
							  <td align="right"><h6>Venta total: </h6></td>
							  <td><h6 id="venta_total"></h6></td>
							</tr>
							<tr>
							  <td align="right"><h6>Facturas: </h6></td>
							  <td><h6 id="cantidad_fact"></h6></td>
							</tr>
						  </tbody>
						</table>
						
						
					</div>
  					
	  					</div>
  					
	  					</div>
	  				</div>
	  			</div>
	  			<div class="col-md-6">
	  				<div class="row titulo_reporte">
	  					<h6>Venta por Categoría</h6>
	  				</div>
	  				<div class="row cuerpo_reporte">
	  				<div class="col-md-12">
	  					<div class="row"><h6>Rango de fecha</h6></div>
	  					<div class="input-daterange input-group" id="rango_fecha2" >
									
							<div class="col-md-6 input-group mb-3 date ">
								<input type="text" name="start2" id="start2" class="fecha form-control" aria-describedby="basic-addon2" placeholder="fecha inicio"> 
								<div class="input-group-append ">
									<span class="ico_fec" id="basic-addon2"><span class="fa fa-calendar-alt fa-1x"></span><span class="input-group-addon"></span>
								</div>
							</div>
							<div class="col-md-6 input-group mb-3 date">
								<input type="text"name="end2" id="end2" class="fecha form-control" aria-describedby="basic-addon2" placeholder="fecha final"> 
								<div class="input-group-append ">
									<span class="ico_fec" id="basic-addon2"><span class="fa fa-calendar-alt"></span><span class="input-group-addon"></span>
								</div>
							</div>
								
							<div class="col-md-12" align="right">
							<button class="btn boton_titulo" onClick="traer_reporte2()" >Generar</button></div>
							
							
						</div>
						
 						<div class="row" >
 						
 							<div class="col-md-12">
						
					  <table class="table table-responsive table-hover tabla" >
						  <thead>
							<tr>
							  <th style="width: 10%" scope="col">Categoria</th>
							  <th style="width: 10%" scope="col">Cantidad</th>
							  <th style="width: 80%; text-align: center" scope="col">Porcentaje en venta</th>
							</tr>
						  </thead>
						  <tbody id="grafica2">
							<tr>
							  <th >marihuna</th>
							  <td>500</td>
							  <td>
					  				<div class="progress" >
						  				<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 59%">59%</div>
						  			</div>
						  	  </td>
							</tr>
							<tr>
							  <th >remedio</th>
							  <td>100</td>
							  <td>
					  				<div class="progress" >
						  				<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 12%">12%</div>
						  			</div>
						  	  </td>
							</tr>
							<tr>
							  <th >hierba</th>
							  <td>200</td>
							  <td>
					  				<div class="progress" >
						  				<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 23%">23%</div>
						  			</div>
						  	  </td>
							</tr>
							<tr>
							  <th >pastillas</th>
							  <td>50</td>
							  <td>
					  				<div class="progress" >
						  				<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 6%">6%</div>
						  			</div>
						  	  </td>
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
		</div>	
		
	</div>
		
</div>

</div>
	
</section>
</body>

<?php include("pie.php"); ?>

<script src="../../code/highcharts.js"></script>
<script src="../../code/exporting.js"></script>
<script src="../../code/export-data.js"></script>
<script src="../../code/modules/series-label.js"></script>

<script>
var date=new Date();
	var dia=date.getDate();
	var mes=date.getMonth()+1;
	var año=date.getFullYear();
	var hoy=año+'-'+mes+'-'+(dia);
	var mañana =año+'-'+mes+'-'+(dia*1+1);
	$("#start").val(hoy);
	$("#end").val(mañana);
	$("#start2").val(hoy);
	$("#end2").val(mañana);
	traer_reporte1();
	traer_reporte2();
	  $("#datetime").datepicker({
    	 language: "es",
		 format: "yyyy-mm-dd",
		  startDate: hoy,
		  todayBtn: true
	  });
	
	$('#rango_fecha').datepicker({
		 language: "es",
		 format: "yyyy-mm-dd",
		});
	$('#rango_fecha2').datepicker({
		 language: "es",
		 format: "yyyy-mm-dd",
		});
	
	function traer_reporte1(){
		$("#venta_total").html('0');
		$("#cantidad_fact").html('0');
		$("#iva").html('0');
		$("#neta").html('0');
		$.ajax({
			
			url:'../../controlador/controlador_reporte.php',
			type:'post',
			dataType:'json',
			data:{operador:'consultar_ventas_totales',start:$("#start").val(),end:$("#end").val()},
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
					//alert(JSON.stringify(vector));
						//grafica2(labels,vector);
					grafica2(labels,vector);
					$("#alerta_reporte1").html('');
				}else{
					
					$("#alerta_reporte1").html(respuesta['alerta']);
					$("#container").html('');
				}
			}
		});
	}
	function traer_reporte2(){
		$.ajax({
			
			url:'../../controlador/controlador_reporte.php',
			type:'post',
			data:{operador:'consultar_ventas_tipo',start2:$("#start2").val(),end2:$("#end2").val()},
			success:function(respuesta){
				
				$("#grafica2").html(respuesta);
				
			}
		});
	}
	function grafica2(fechas, datos){
		Highcharts.chart('container', {

    title: {
        text: ''
    },
	
    yAxis: {
        title: {
            text: 'Venta'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
           
		}
    },

    series: [{
        name: 'venta',
		data: datos,
		lineColor: 'rgba(32,41,63,1.00)',
        color: 'rgba(162,161,161,1.00)',
    },],
	
	xAxis: {
        categories: fechas,
        crosshair: true
    },

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
	}
	
</script>

<script type="text/javascript">


		</script>

</html>