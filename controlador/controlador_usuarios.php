<?php
	session_start();
	include('../modelo/modelo_usuario.php');
	$persona = new persona;
	
	if (isset($_REQUEST['operador'])){
		
		$operador=$_REQUEST['operador'];
		
		switch ($operador){
			
			case 'registrar_usua':
				
				$persona->insertar_usuario($_POST['documento'], $_POST['nombre'], $_POST['telefono'], $_POST['correo'],$_POST['direccion'], $_POST['contrasena'], $_POST['rol']);	
				break;
				
		   case 'consultar_usua':
				$Busqueda = $_REQUEST['busqueda'];
				$Pagina = $_REQUEST['pagina'];
				$persona->consultar_usuario($Busqueda,$Pagina);
				break;
				
			case 'actualizar_usua':
				
				$persona->actualizar_usuario($_POST['documento2_pers'], $_POST['nombre_pers'], $_POST['telefono_pers'], $_POST['correo_pers'],$_POST['direccion_pers'], $_POST['contrasena_pers'], $_POST['rol_pers']);
				
				break;
				
			case 'traer_usua':
				
				$persona->traer_usua($_REQUEST['documento']);
				
				break;
				
			case 'estado_usua':
				
				$persona->estado_usua($_REQUEST['documento']);
				
				break;
				
			case 'sesion':
			
				$persona->sesion($_REQUEST['usuario'],$_REQUEST['pass']);
				
				break;
				
		}
		
	}else{
		echo('face');
	}
	

?>