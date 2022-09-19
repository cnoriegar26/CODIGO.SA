<?php

include('../modelo/modelo_compra.php');
	$compra = new compra;
	
	if (isset($_REQUEST['operador'])){
		
		$operador=$_REQUEST['operador'];
		
		switch ($operador){
		
			case 'insertar_comp':
				$fecha=strtotime($_REQUEST['fecha_compra']);
				$fecha_compra=date("Y-m-d",$fecha);
				
				$compra->insertar_compra($_REQUEST['codigo_fatc'],$_REQUEST['proveedor'],$_REQUEST['valor'],$fecha_compra,$_FILES['imagen']);
				break;
				
			case 'consultar_comp':
				$compra->consultar_compra($_REQUEST['busqueda'],$_REQUEST['pagina']);
				break;
			case 'pdf_comp':
				$compra->busqueda($_REQUEST['busqueda']);
				//$compra->generar_pdf($_REQUEST['html']);
				break;
		}
		
	}else{
		
	}
		

?>