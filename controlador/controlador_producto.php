<?php

	include('../modelo/modelo_producto.php');

	$producto = new producto;
	
	if (isset($_REQUEST['operador'])){
		
		$operador=$_REQUEST['operador'];
		
		switch ($operador){
			
			case 'cargar_prov':				
					$producto->cargar_proveedores();				
				break;
		   case 'cargar_tipo':
					$producto->cargar_tipo();
				break;
				
			case 'registrar_prod':			
				
				if($_REQUEST['fecha_venc']==''){
					$fecha='';
					
				}else{
					$fecha=strtotime($_REQUEST['fecha_venc']);
					$fecha_venc=date("Y-m-d",$fecha);
					
				}
				
					$producto->insertar_producto($_REQUEST['nombre'], $_REQUEST['descripcion'], $_REQUEST['precio'], $_REQUEST['cantidad'],$fecha_venc, $_REQUEST['proveedor'], $_REQUEST['tipo'], $_FILES['foto']);				
				break;
				
			case 'actualizar_prod':					
					$producto->actualizar_preducto($_REQUEST['codigo2'], $_REQUEST['nombre_prod'], $_REQUEST['descripcion_prod'], $_REQUEST['precio_prod'],$_REQUEST['proveedor_prod'], $_REQUEST['tipo_prod'], $_FILES['imagen2']);				
				break;
				
			case 'traer_prod':					
					$producto->traer_producto($_REQUEST['codigo']);					
				break;
				
			case 'consultar_prod':
					$Busqueda = $_REQUEST['busqueda'];
					$Pagina = $_REQUEST['pagina'];
					$producto->consultar_productos2($Busqueda,$Pagina);
				break;
				
			case 'consultar_prod_gale':
					$Pagina = $_REQUEST['pagina'];
					$producto->consultar_productos_galeria($Pagina);
				break;
				
			case 'estado':
				
				$producto->estado_prod($_REQUEST['codigo']);
				
				break;
				
			default:
				echo ('no llamo');
				break;
		}
		
	}else{
		echo ('false');
	}
	

?>