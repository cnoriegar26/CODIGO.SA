<?php
	include('../modelo/modelo_empresa.php');
	$empresa = new empresa;
	
	if (isset($_REQUEST['operador'])){
		
		$operador=$_REQUEST['operador'];
		
		switch ($operador){
		
			case 'registrar_empresa':
				
				$empresa->registrar_empresa($_REQUEST['nit'], $_REQUEST['nombre'], $_REQUEST['direccion'], $_REQUEST['telefono'], $_REQUEST['correo'], $_REQUEST['mision'], $_REQUEST['vision']);
				
				break;
				
			case 'traer_empresa':
				$empresa->traer_empresa();
				break;
			case 'actualizar_empresa':
				$empresa->actualizar_empresa($_REQUEST['nit2'], $_REQUEST['nombre'], $_REQUEST['direccion'], $_REQUEST['telefono'], $_REQUEST['correo'], $_REQUEST['mision'], $_REQUEST['vision']);
				break;
		}
		
	}else{
		
	}
?>