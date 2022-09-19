<?php

		include('../modelo/modelo_reporte.php');
	
	$reporte = new reporte;
	

	if (isset($_REQUEST['operador'])){
		
		$operador=$_REQUEST['operador'];
		
		switch ($operador){
			
			case 'consultar_ventas_totales':
				
				$start=strtotime($_REQUEST['start']);
				$start_format=date("Y-m-d",$start);
				$end=strtotime($_REQUEST['end']);
				$end_format=date("Y-m-d",$end);
				
				$reporte->consultar_ventas_totales($start_format,$end_format);
				
				break;
				
			case 'consultar_ventas_tipo':
				
				$start=strtotime($_REQUEST['start2']);
				$start_format=date("Y-m-d",$start);
				$end=strtotime($_REQUEST['end2']);
				$end_format=date("Y-m-d",$end);
				
				$reporte->consulta_tipo_prod($start_format,$end_format);
				
				break;
		}
		
	}else{
		
	}

?>