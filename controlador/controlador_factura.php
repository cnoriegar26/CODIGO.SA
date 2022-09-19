<?php session_start();
	include('../modelo/modelo_factura.php');
	
	$factura = new factura();
	

	if (isset($_REQUEST['operador'])){
		
		$operador=$_REQUEST['operador'];
		
		switch ($operador){
			
			case 'consultar_clie':
				
				$Busqueda = $_REQUEST['busqueda'];
				$Pagina = $_REQUEST['pagina'];
				$factura->listclinte($Busqueda,$Pagina);
				
				break;
		   case 'consultar_prod':
				
				$Busqueda = $_REQUEST['busqueda'];
				$Pagina = $_REQUEST['pagina'];
				$factura->consultar_stock($Busqueda,$Pagina);
				
				break;
			case 'insertar_fact':
					
				$factura->insertar_factura($_REQUEST['productos'],$_REQUEST['subtotal'],$_REQUEST['cliente']);
					
				break;
				
			case 'crear_pdf':				
				$factura->crear_pdf($_REQUEST['productos'],$_REQUEST['subtotal'],$_REQUEST['cliente'],$_REQUEST['tipo_fact'],$_REQUEST['fecha_fact']);				
				break;
				
			case 'traer_prod_fact':				
				$factura->traer_producto_fact($_REQUEST['codigo'],$_REQUEST['cantidad'],$_REQUEST['disponible']);				
				break;
				
			case 'traer_clie_fact':				
				$factura->traer_clie_factura($_REQUEST['documento']);				
				break;
				
			case 'consultar_fact':
				
				$Busqueda = $_REQUEST['busqueda'];
				$Pagina = $_REQUEST['pagina'];
				$factura->consultar_factura($Busqueda,$Pagina);				
				break;
				
			case 'consultar_pedi':
				
				$Busqueda = $_REQUEST['busqueda'];
				$Pagina = $_REQUEST['pagina'];
				$factura->consultar_pedidos($Busqueda,$Pagina);				
				break;
				
			case 'consultar_comp':				
				$Busqueda = $_REQUEST['busqueda'];
				$Pagina = $_REQUEST['pagina'];
				$factura->consultar_compras($Busqueda,$Pagina);				
				break;
				
			case 'cantidad_pedi':				
				$factura->cantidad_pedidos();				
				break;
				
			case 'enviar':
				$factura->estado_factura($_REQUEST['codigo']);
				break;
			case 'consecutivo':
				echo($factura->traer_consecutivo());
				break;
				
		}
		
	}else{
		
	}
?>