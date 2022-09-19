<?php

	include('../modelo/modelo_proveedores.php');

	$proveedor=new proveedor;
	if (isset($_REQUEST['operador'])){
		
		$operador=$_REQUEST['operador'];
		
		switch ($operador){
			
			case 'registrar_prov':
					$proveedor->insertar_proveedor($_REQUEST['nit'],$_REQUEST['nombre'],$_REQUEST['telefono'], $_REQUEST['correo'], $_REQUEST['direccion'],$_REQUEST['descripcion']);
				break;
				
		   case 'consultar_prov':
				
				$Busqueda = $_REQUEST['busqueda'];
				$Pagina = $_REQUEST['pagina'];
				$proveedor->consultar_proveedores($Busqueda,$Pagina);
				break;
				
			case 'actualizar_prov':
				$proveedor->actualizar_proveedor($_REQUEST['nit2'],$_REQUEST['nombre_prov'],$_REQUEST['telefono_prov'], $_REQUEST['correo_prov'], $_REQUEST['direccion_prov'],$_REQUEST['descripcion_prov']);
				
				break;
				
			case 'traer_prov':
				
				
				$proveedor->traer_proveedor($_REQUEST['nit']);
				
				break;
				
			case 'estado':
				
				$proveedor->estado_prov($_REQUEST['nit']);
				
				break;
				
			default:
				echo ($operador);
				break;
				
		}
		
	}else{
		echo false;
	}

?>