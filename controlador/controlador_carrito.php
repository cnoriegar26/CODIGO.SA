<?php
session_start();

	include('../modelo/modelo_carrito.php');
	
	$carrito = new carrito;
	

	if (isset($_REQUEST['operador'])){
		
		$operador=$_REQUEST['operador'];
		
		switch ($operador){
			
			case 'agregar_carrito':
				$carrito->agregar_car($_REQUEST['cantidad'],$_REQUEST['valor'],$_REQUEST['codigo']);
				break;
				
			case 'traer_addom':
				$carrito->traer_addom();
				break;
			case 'traer_carrito':
				$carrito->traer_carrito();
				break;
			case 'traer_pedido':
				$codigo = $_REQUEST['codigo'];
				$carrito->traer_pedido($codigo);
				break;
			case 'traer_compra':
				$codigo = $_REQUEST['codigo'];
				$carrito->traer_compra($codigo);
				break;
			case 'traer_total_pedido':
				$codigo = $_REQUEST['codigo'];
				$carrito->traer_total_pedido($codigo);
				break;
			case 'traer_total_compra':
				$codigo = $_REQUEST['codigo'];
				$carrito->traer_total_compra($codigo);
				break;
			case 'traer_total':
				$carrito->traer_total();
				break;
			case 'eliminar_car':
				$carrito->eliminar_carrito($_REQUEST['codigo']);
				break;
			case 'agregar_car':
				$carrito->agregar_car2($_REQUEST['codigo'],$_REQUEST['cantidad']);
				break;
			case 'confirm_inve':
				$carrito->confirm_inve();
				break;
		}
		
		
	}else{
		
	}
?>