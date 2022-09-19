<?php
	
	include('../modelo/modelo_clientes.php');
	$cliente=new cliente;
	if (isset($_REQUEST['operador'])){
		
		$operador=$_REQUEST['operador'];
		
		switch ($operador){
			
			case 'registrar_clie':
				
				$cliente->insertar_cliente($_POST['documento'], $_POST['nombre'], $_POST['telefono'],$_POST['correo'], $_POST['direccion']);	
				break;
				
		   case 'consultar_clie':
				$Busqueda = $_REQUEST['busqueda'];
				$Pagina = $_REQUEST['pagina'];
				$cliente->consultar_cliente($Busqueda,$Pagina);
				break;
				
			case 'actualizar_clie':
				
				$cliente->actualizar_cliente($_POST['documento2'], $_POST['nombre_pers'], $_POST['telefono_pers'], $_POST['correo_pers'],$_POST['direccion_pers']);
				
				break;
				
			case 'traer_clie':
				
				$cliente->traer_cliente($_REQUEST['documento']);
				
				break;
			case 'pdf_comp':
				$cliente->busqueda($_REQUEST['busqueda']);
				//$compra->generar_pdf($_REQUEST['html']);
				break;
				
		}
		
	}else{
		echo('false');
	}
	
	

?>