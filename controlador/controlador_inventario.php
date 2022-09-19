<?php
	include('../modelo/modelo_inventario.php');

	$inventario = new inventario;
	
	if (isset($_REQUEST['operador'])){
		
		$operador=$_REQUEST['operador'];
		
		switch ($operador){
			
			case 'cargar_prod_inve':
				$inventario->cargar_productio($_REQUEST['busqueda']);
				break;
			case 'cargar_prov_inve':
				$inventario->cargar_proveedor($_REQUEST['busqueda']);
				break;
			case 'insertar_stoc';
				
				if($_REQUEST['fecha_venc']==''){
					$fecha='';
				}else{
					$fecha=strtotime($_REQUEST['fecha_venc']);
					$fecha_venc=date("Y-m-d",$fecha);
					
				}
				
				$inventario->insertar_stock($_REQUEST['nombre'],$_REQUEST['proveedor'],$fecha_venc,$_REQUEST['cantidad']);
				break;
			case 'consultar_stoc':
				$Busqueda = $_REQUEST['busqueda'];
				$Pagina = $_REQUEST['pagina'];
				$inventario->consultar_productos($Busqueda,$Pagina);
				
				break;
			case 'traer_stoc':
				$inventario->traer_stock($_REQUEST['codigo_stoc']);
				break;
				
			case 'actualizar_stoc':
				$inventario->actualizar_stoc($_REQUEST['codigo2'],$_REQUEST['fecha_venc_inve'],$_REQUEST['cantidad_inve']);
				break;
			case 'pdf_comp':
				$inventario->busqueda($_REQUEST['busqueda']);
				//$compra->generar_pdf($_REQUEST['html']);
				break;
				
			default:
				
				echo('default');
				
				break;
		}
		
	}else{
		echo ('false');
	}
	

?>