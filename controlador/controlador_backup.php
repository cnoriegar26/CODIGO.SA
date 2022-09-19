<?php
	include('../modelo/modelo_backup.php');

	$backup = new backup;
	
	if (isset($_REQUEST['operador'])){
		
		$operador=$_REQUEST['operador'];
		
		switch ($operador){
			
				case 'crear_back':
				
					$backup->crear_backup();
					
				break;
				
		   case 'consultar_back':
				
				$backup->consultar_backup($_REQUEST['fecha_back']);
				
				break;
										
		}
		
	}else{
		echo ('false');
	}
	

?>